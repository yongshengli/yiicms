<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-widgets
 * @subpackage yii2-widget-affix
 * @version 1.0.0
 */

namespace kartik\affix;

/**
 * Asset bundle for Affix Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class AffixAsset extends \kartik\base\AssetBundle
{
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/affix']);
        $this->setupAssets('js', ['js/affix']);
        parent::init();
    }
}
