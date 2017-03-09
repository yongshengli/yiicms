<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-depdrop
 * @version 1.0.4
 */

namespace kartik\depdrop;

use kartik\base\AssetBundle;

/**
 * Asset bundle for Dependent Dropdown Extension for Yii
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class DepDropExtAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('js', ['js/depdrop']);
        parent::init();
    }
}
