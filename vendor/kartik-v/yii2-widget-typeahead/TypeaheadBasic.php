<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2015
 * @package yii2-widgets
 * @subpackage yii2-widget-typeahead
 * @version 1.0.1

 */

namespace kartik\typeahead;

use yii\web\JsExpression;
use yii\helpers\Json;
use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\web\View;

/**
 * Typeahead widget is a Yii2 wrapper for the Twitter typeahead.js plugin. This
 * input widget is a jQuery based replacement for text inputs providing search
 * and typeahead functionality. It is inspired by twitter.com's autocomplete search
 * functionality and based on Twitter's typeahead.js which Twitter mentions as
 * a fast and fully-featured autocomplete library.
 *
 * This is a basic implementation of typeahead.js without using any suggestion engine.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 * @see http://twitter.github.com/typeahead.js/examples
 */
class TypeaheadBasic extends \kartik\base\InputWidget
{
    /**
     * @var bool whether the dropdown menu is scrollable
     */
    public $scrollable = false;

    /**
     * @var bool whether RTL support is to be enabled
     */
    public $rtl = false;
    
    /**
     * @var array dataset an object that defines a set of data that hydrates suggestions.
     * For TypeaheadBasic, this is a single dimensional array consisting of following settings. 
     * For Typeahead, this is a multi-dimensional array, with each array item being an array that 
     * consists of the following settings.
     * - source: The backing data source for suggestions. Expected to be a function with the 
     *   signature `(query, syncResults, asyncResults)`. This can also be a Bloodhound instance.
     *   If not set, this will be automatically generated based on the bloodhound specific
     *   properties in the next section below.
     * - display: string the key used to access the value of the datum in the datum
     *   object. Defaults to 'value'.
     * - async: boolean, lets the dataset know if async suggestions should be expected. Defaults to `true`.     
     * - limit: integer the max number of suggestions from the dataset to display for
     *   a given query. Defaults to 5.
     * - templates: array the templates used to render suggestions.
     * The following properties are bloodhound specific data configuration properties and not applicable
     * for TypeaheadBasic. Its only applied for Typeahead.
     * - local: array configuration for the [[local]] list of datums. You must set one of
     *   [[local]], [[prefetch]], or [[remote]].
     * - prefetch: array configuration for the [[prefetch]] options object.
     * - remote: array configuration for the [[remote]] options object.
     * - initialize: true,
     * - identify: defaults to _.stringify,
     * - datumTokenizer: defaults to null,
     * - queryTokenizer: defaults null,
     * - sufficient: 5,
     * - sorter: null,
     */
    public $dataset = [];

    /**
     * @var array the HTML attributes for container enclosing the input
     */
    public $container = [];

    /**
     * Runs the widget
     *
     * @return string|void
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        if (empty($this->data) || !is_array($this->data)) {
            throw new InvalidConfigException("You must define the 'data' property for Typeahead which must be a single dimensional array.");
        }
        $this->registerAssets();
        $this->initOptions();
        echo Html::tag('div', $this->getInput('textInput'), $this->container);
    }

    /**
     * Initializes options
     */
    protected function initOptions()
    {
        Html::addCssClass($this->options, 'form-control');
        if ($this->scrollable) {
            Html::addCssClass($this->container, 'tt-scrollable-menu');
        }
        if ($this->rtl) {
            $this->options['dir'] = 'rtl';
            Html::addCssClass($this->container, 'tt-rtl');
        }
    }

    /**
     * Registers plugin events
     *
     * @param View $view The View object
     */
    protected function registerPluginEvents($view)
    {
        if (!empty($this->pluginEvents)) {
            $id = 'jQuery("#' . $this->options['id'] . '")';
            $js = [];
            foreach ($this->pluginEvents as $event => $handler) {
                $function = new JsExpression($handler);
                $js[] = "{$id}.on('{$event}', {$function});";
            }
            $js = implode("\n", $js);
            $view->registerJs($js);
        }
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        TypeaheadBasicAsset::register($view);
        $this->registerPluginOptions('typeahead');
        $data = Json::encode(array_values($this->data));
        $dataVar = 'kvTypData_' . hash('crc32', $data);
        $view->registerJs("var {$dataVar} = {$data};", View::POS_HEAD);
        $this->dataset['name'] = $dataVar;
        if (!isset($this->dataset['source'])) {
            $this->dataset['source'] = new JsExpression('kvSubstringMatcher(' . $dataVar . ')');
        }
        $id = 'jQuery("#' . $this->options['id'] . '")';
        $dataset = Json::encode($this->dataset);
        $js = "{$id}.typeahead({$this->_hashVar}, {$dataset});";
        $view->registerJs($js);
        $this->registerPluginEvents($view);
    }
}