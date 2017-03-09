<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-widgets
 * @subpackage yii2-widget-typeahead
 * @version 1.0.1
 */

namespace kartik\typeahead;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Typeahead widget is a Yii2 wrapper for the Twitter typeahead.js plugin. This
 * input widget is a jQuery based replacement for text inputs providing search
 * and typeahead functionality. It is inspired by twitter.com's autocomplete search
 * functionality and based on Twitter's typeahead.js which Twitter mentions as
 * a fast and fully-featured autocomplete library.
 *
 * This is an advanced implementation of the typeahead.js plugin included with the
 * Bloodhound suggestion engine.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 * @see http://twitter.github.com/typeahead.js/examples
 */
class Typeahead extends TypeaheadBasic
{
    /**
     * @var bool whether to register and use Handle Bars Template compiler plugin. 
     * Defaults to `true`.
     */
    public $useHandleBars = true;

    /**
     * @var array the list of default values/suggestions that will be displayed on init
     * or when text queried is empty. This feature will be disabled if an empty array or
     * invalid array is passed.
     */
    public $defaultSuggestions = [];

    /**
     * @var array the HTML attributes for the input tag.
     */
    public $options = [];

    /**
     * @var string the generated Bloodhound script
     */
    protected $_bloodhound;

    /**
     * @var string the generated Json encoded Dataset script
     */
    protected $_dataset;
    
    /**
     * @var bool whether default suggestions are enabled
     */
    protected $_defaultSuggest = false;
    
    /**
     * @var array the bloodhound settings variables
     */
    protected static $_bhSettings = [
        'datumTokenizer',
        'queryTokenizer',
        'initalize',
        'sufficient',
        'sorter',
        'identify',
        'local',
        'prefetch',
        'remote'
    ];

    /**
     * Runs the widget
     *
     * @return string|void
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        if (empty($this->dataset) || !is_array($this->dataset)) {
            throw new InvalidConfigException("You must define the 'dataset' property for Typeahead which must be an array.");
        }
        if (!is_array(current($this->dataset))) {
            throw new InvalidConfigException("The 'dataset' array must contain an array of datums. Invalid data found.");
        }
        $this->_defaultSuggest = is_array($this->defaultSuggestions) && !empty($this->defaultSuggestions);
        if ($this->_defaultSuggest) {
            $this->pluginOptions['minLength'] = 0;
        }
        $this->validateConfig();
        $this->initDataset();
        $this->registerAssets();
        $this->initOptions();
        echo Html::tag('div', $this->getInput('textInput'), $this->container);
    }

    /**
     * @return void Validate if configuration is valid
     * @throws \yii\base\InvalidConfigException
     */
    protected function validateConfig()
    {
        foreach ($this->dataset as $datum) {
            if (empty($datum['local']) && empty($datum['prefetch']) && empty($datum['remote'])) {
                throw new InvalidConfigException("No data source found for the Typeahead. The 'dataset' array must have one of 'local', 'prefetch', or 'remote' settings enabled.");
            }
        }
    }

    /**
     * Initialize the data set
     */
    protected function initDataset()
    {
        $index = 1;
        $this->_bloodhound = '';
        $this->_dataset = '';
        $dataset = [];
        foreach ($this->dataset as $datum) {
            $dataVar = strtr(strtolower($this->options['id'] . '_data_' . $index), ['-' => '_']);
            $this->_bloodhound .= $this->parseSource($dataVar, $datum) . "\n";
            $d = $datum;
            $d['name'] = $dataVar;
            if (empty($d['source'])) {
                if ($this->_defaultSuggest) {
                    $sug = Json::encode($this->defaultSuggestions);
                    $sugVar = 'kvTypData_' . hash('crc32', $sug);
                    $this->getView()->registerJs("var {$sugVar} = {$sug};", View::POS_HEAD);
                    $source = "function(q,s){if(q===''){s({$dataVar}.get({$sugVar}));}else{{$dataVar}.search(q,s);}}";
                } else {
                    $source = "{$dataVar}.ttAdapter()";
                }
                $d['source'] = new JsExpression($source);
            }
            $dataset[] = $d;
            $index++;
        }
        $this->_dataset .= Json::encode($dataset);
    }

    /**
     * Parses a variable and force converts it to JsExpression
     * @param mixed $expr
     * @return JsExpression
     */
    protected static function parseJsExpr($expr)
    {
        return ($expr instanceof JsExpression) ? $expr : new JsExpression($expr);
    }
    
    /**
     * Parses the data source array and prepares the bloodhound configuration
     *
     * @param string $dataVar the variable to store the Bloodhound instance
     * @param array $source the source data
     * @return string the prepared bloodhound configuration
     */
    protected function parseSource($dataVar, &$source)
    {
        $out = [];
        $defaultToken = new JsExpression("Bloodhound.tokenizers.whitespace");
        foreach (self::$_bhSettings as $key) {
            if ($key === 'datumTokenizer' || $key === 'queryTokenizer') {
                $out[$key] = self::parseJsExpr(ArrayHelper::remove($source, $key, $defaultToken));
            }
            if (isset($source[$key])) {
                $out[$key] = $source[$key];
                if ($key === 'local') {
                    $local = Json::encode($source[$key]);
                    $localVar = 'kvTypData_' . hash('crc32', $local);
                    $this->getView()->registerJs("var {$localVar} = {$local};", View::POS_HEAD);
                    $out[$key] = new JsExpression($localVar);
                } elseif ($key === 'prefetch') {
                    $prefetch = $source[$key];
                    if (!is_array($prefetch)) {
                        $prefetch = ['url' => $prefetch];
                    }
                    $out[$key] = $prefetch;
                }
                unset($source[$key]);
            }
        }
        return "var {$dataVar} = new Bloodhound(" . Json::encode($out) . ");";
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        TypeaheadAsset::register($view);
        if ($this->useHandleBars) {
            TypeaheadHBAsset::register($view);
        }
        $this->registerPluginOptions('typeahead');
        $id = $this->options['id'];
        $view->registerJs("{$this->_bloodhound}kvInitTA('{$id}', {$this->_hashVar}, {$this->_dataset});");
        $this->registerPluginEvents($view);
    }
}
