<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-widgets
 * @subpackage yii2-widget-spinner
 * @version 1.0.0
 */

namespace kartik\spinner;

use Yii;

/**
 * Asset bundle for Spinner Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class SpinnerAsset extends \kartik\base\AssetBundle
{
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/spin']);
        $this->setupAssets('js', ['js/spin', 'js/jquery.spin']);
        parent::init();
    }
}
