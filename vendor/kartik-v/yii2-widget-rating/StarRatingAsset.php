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
 * Asset bundle for StarRating Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StarRatingAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setSourcePath('@vendor/kartik-v/bootstrap-star-rating');
        $this->setupAssets('css', ['css/star-rating']);
        $this->setupAssets('js', ['js/star-rating']);
        parent::init();
    }
}
