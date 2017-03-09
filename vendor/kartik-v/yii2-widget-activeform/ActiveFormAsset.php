<?php

/**
 * @copyright  Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2016
 * @package    yii2-widgets
 * @subpackage yii2-widget-activeform
 * @version    1.4.8
 */

namespace kartik\form;
use kartik\base\AssetBundle;

/**
 * Asset bundle for ActiveForm Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class ActiveFormAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->depends = array_merge($this->depends, [            
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapPluginAsset'
        ]);
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/activeform']);
        $this->setupAssets('js', ['js/activeform']);
        parent::init();
    }
}
