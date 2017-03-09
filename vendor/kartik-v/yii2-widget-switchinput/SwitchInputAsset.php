<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-switchinput
 * @version 1.3.1
 */

namespace kartik\switchinput;

use kartik\base\AssetBundle;

/**
 * Asset bundle for Switch Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class SwitchInputAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/bootstrap-switch', 'css/bootstrap-switch-kv']);
        $this->setupAssets('js', ['js/bootstrap-switch']);
        parent::init();
    }
}
