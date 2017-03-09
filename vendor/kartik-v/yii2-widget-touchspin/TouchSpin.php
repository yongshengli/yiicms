<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-touchspin
 * @version 1.2.1
 */

namespace kartik\touchspin;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\base\InputWidget;

/**
 * TouchSpin widget is a Yii2 wrapper for the bootstrap-touchspin plugin by István Ujj-Mészáros. This input widget is a
 * mobile and touch friendly input spinner component for Bootstrap 3.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 * @see http://www.virtuosoft.eu/code/bootstrap-touchspin/
 */
class TouchSpin extends InputWidget
{
    /**
     * @inheritdoc
     */
    public $pluginName = 'TouchSpin';

    /**
     * @inheritdoc
     */
    public function run()
    {
        parent::run();
        $this->setPluginOptions();
        $this->registerAssets();
        echo $this->getInput('textInput');
    }

    /**
     * Set the plugin options
     */
    protected function setPluginOptions()
    {
        $css = $this->disabled ? 'btn btn-default disabled' : 'btn btn-default';
        $defaults = [
            'buttonup_class' => $css,
            'buttondown_class' => $css,
            'buttonup_txt' => '<i class="glyphicon glyphicon-forward"></i>',
            'buttondown_txt' => '<i class="glyphicon glyphicon-backward"></i>',
        ];
        $this->pluginOptions = array_replace_recursive($defaults, $this->pluginOptions);
        if (ArrayHelper::getValue($this->pluginOptions, 'verticalbuttons', false) &&
            empty($this->pluginOptions['prefix'])
        ) {
            Html::addCssClass($this->options, 'input-left-rounded');
        }
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        TouchSpinAsset::register($view);
        $this->registerPlugin($this->pluginName);
    }
}
