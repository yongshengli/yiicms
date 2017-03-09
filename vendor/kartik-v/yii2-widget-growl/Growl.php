<?php
/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-widgets
 * @subpackage yii2-widget-growl
 * @version 1.1.1
 */

namespace kartik\growl;

use Yii;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use kartik\base\AnimateAsset;

/**
 * Widget that wraps the Bootstrap Growl plugin by remabledesigns.
 *
 * @http://bootstrap-growl.remabledesigns.com/
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class Growl extends \kartik\base\Widget
{
    const TYPE_INFO = 'info';
    const TYPE_DANGER = 'danger';
    const TYPE_SUCCESS = 'success';
    const TYPE_WARNING = 'warning';
    const TYPE_GROWL = 'growl';
    const TYPE_MINIMALIST = 'minimalist';
    const TYPE_PASTEL = 'pastel';
    const TYPE_CUSTOM = 'custom';

    /**
     * @var string the type of the alert to be displayed. One of the `TYPE_` constants.
     * Defaults to `TYPE_INFO`
     */
    public $type = self::TYPE_INFO;

    /**
     * @var string the class name for the icon
     */
    public $icon = '';

    /**
     * @var string the title for the alert
     */
    public $title = '';
    
    /**
     * @var string the url to redirect to on clicking the alert. If this is <code>null</code> or not set, 
     * the alert will not be clickable.
     */
    public $linkUrl = '';

    /**
     * @var string the target to open the linked notification
     */
    public $linkTarget = '_blank';

    /**
     * @var bool show title separator. Only applicable if `title` is set.
     */
    public $showSeparator = false;

    /**
     * @var string the alert message body
     */
    public $body = '';
    
    /**
     * @var array the HTML options and settings for the bootstrap progress bar. Defaults to:
     * ```
     *  [
     *      'role' => 'progressbar',
     *      'aria-valuenow' => '0',
     *      'aria-valuemin' => '0',
     *      'aria-valuemax' => '100',
     *      'style' => '100',
     *  ]
     * ```
     * The following special options are recognized:
     * - `title`: the progress bar title text/markup.
     */
    public $progressBarOptions = [];

    /**
     * @var integer the delay in microseconds after which the alert will be displayed.
     * Will be useful when multiple alerts are to be shown.
     */
    public $delay;

    /**
     * @var array the options for rendering the close button tag.
     */
    public $closeButton = [];
    
    /**
     * @var use animations
     */
    public $useAnimation = true;
    
    /**
     * @var array the HTML attributes for the growl icon container.
     */
    public $iconOptions = [];
    
    /**
     * @var array the HTML attributes for the growl title container.
     */
    public $titleOptions = [];
    
    /**
     * @var array the HTML attributes for the growl message body.
     */
    public $bodyOptions = [];
    
    /**
     * @var array the HTML attributes for the growl progress bar container.
     */
    public $progressContainerOptions = [];
    
    /**
     * @var array the HTML attributes for the growl url link
     */
    public $linkOptions = [];
    
    /**
     * @var array the bootstrap growl plugin configuration options
     * @see http://bootstrap-growl.remabledesigns.com/
     */
    public $pluginOptions = [];

    /**
     * @var array the list of themes.
     */
    protected static $_themes = [
        self::TYPE_GROWL,
        self::TYPE_MINIMALIST,
        self::TYPE_PASTEL
    ];
    
     /**
     * @var array the first part of growl plugin settings/options 
     */
    private $_settings;    

    /**
     * Initializes the widget
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
    }

    /**
     * Initializes the widget options.
     * This method sets the default values for various options.
     */
    protected function initOptions()
    {
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        $this->_settings = [
            'message' => $this->body,
            'icon' => $this->icon,
            'title' => $this->title,
            'url' => $this->linkUrl,
            'target' => $this->linkTarget
        ];
        $this->progressBarOptions += [
            'role' => 'progressbar',
            'aria-valuenow' => '0',
            'aria-valuemin' => '0',
            'aria-valuemax' => '100',
            'style' => 'width:100%',
        ];
        $this->pluginOptions['type'] = $this->type;
        $class = 'progress';
        $progressTitle = ArrayHelper::remove($this->progressBarOptions, 'title', '');
        if (empty($this->progressContainerOptions['class'])) {
            $class .= ' kv-progress-bar';
        }
        Html::addCssClass($this->progressContainerOptions, $class);
        Html::addCssClass($this->progressBarOptions, 'progress-bar progress-bar-{0}');
        $class = "alert alert-{0}";
        if (empty($this->options['class'])) {
            $this->options['class'] = "col-xs-11 col-sm-3 {$class}";
        } else {
            Html::addCssClass($this->options, $class);
        }
        $divider = !empty($this->showSeparator) && !empty($this->title) ? '<hr class="kv-alert-separator">' . "\n" : '';
        $this->options['role'] = 'alert';
        $this->options['data-notify'] = 'container';
        $this->iconOptions['data-notify'] = 'icon';
        $this->titleOptions['data-notify'] = 'title';
        $this->bodyOptions['data-notify'] = 'message';
        $this->progressContainerOptions['data-notify'] = 'progressbar';
        $this->linkOptions['data-notify'] = 'url';
        $this->linkOptions['target'] = '{4}';
        $iconTag = ArrayHelper::getValue($this->pluginOptions, 'icon_type', 'class') === 'class' ? 'span' : 'img';
        $content = $this->renderCloseButton() . "\n" .
            Html::tag($iconTag, '', $this->iconOptions) . "\n" .
            Html::tag('span', '{1}', $this->titleOptions) . "\n" .
            $divider . 
            Html::tag('span', '{2}', $this->bodyOptions) . "\n" .
            Html::tag('div', Html::tag('div', $progressTitle, $this->progressBarOptions), $this->progressContainerOptions) . "\n" .
            Html::a('', '{3}', $this->linkOptions);
        $this->pluginOptions['template'] = Html::tag('div', $content, $this->options);
        $this->registerAssets();
    }

    /**
     * Renders the close button.
     *
     * @return string the rendering result
     */
    protected function renderCloseButton()
    {
        if ($this->closeButton !== null) {
            $tag = ArrayHelper::remove($this->closeButton, 'tag', 'button');
            $label = ArrayHelper::remove($this->closeButton, 'label', '&times;');
            $label = '<span aria-hidden="true">' . $label . '</span>';
            Html::addCssClass($this->closeButton, 'close');
            if ($tag === 'button' && !isset($this->closeButton['type'])) {
                $this->closeButton['type'] = 'button';
            }
            $this->closeButton['data-notify'] = 'dismiss';
            return Html::tag($tag, $label, $this->closeButton);
        } else {
            return '';
        }
    }

    /**
     * Register client assets
     */
    protected function registerAssets()
    {
        $view = $this->getView();
        if (in_array($this->type, self::$_themes)) {
            GrowlAsset::register($view)->addTheme($this->type);
        } else {
            GrowlAsset::register($view);
        }
        if ($this->useAnimation) {
            AnimateAsset::register($view);
        }
        $this->registerPluginOptions('notify');
        $js = '$.notify(' . Json::encode($this->_settings) . ', ' . $this->_hashVar . ');';
        if (!empty($this->delay) && $this->delay > 0) {
            $js = 'setTimeout(function () {' . $js . '}, ' . $this->delay . ');';
        }
        $view->registerJs($js);
    }
}
