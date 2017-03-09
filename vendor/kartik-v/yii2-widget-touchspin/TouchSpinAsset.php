<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-touchspin
 * @version 1.2.1
 */

namespace kartik\touchspin;

use kartik\base\AssetBundle;

/**
 * Asset bundle for TouchSpin Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class TouchSpinAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/bootstrap-touchspin']);
        $this->setupAssets('js', ['js/bootstrap-touchspin']);
        parent::init();
    }
}
