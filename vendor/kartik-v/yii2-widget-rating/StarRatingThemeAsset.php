<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-rating
 * @version 1.0.2
 */

namespace kartik\rating;

use kartik\base\AssetBundle;

/**
 * Theme Asset bundle for StarRating Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StarRatingThemeAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/kartik-v/bootstrap-star-rating';

    /**
     * @inheritdoc
     */
    public $depends = [
        'kartik\rating\StarRatingAsset'
    ];
    
    /**
     * Add star rating theme file
     *
     * @param string $theme the theme file name
     */
    public function addTheme($theme) 
    {
        $this->css[] = "css/theme-{$theme}." . (YII_DEBUG ? "css" : "min.css");
    }
}