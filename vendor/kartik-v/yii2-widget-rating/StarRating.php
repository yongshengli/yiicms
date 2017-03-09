<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2016
 * @package yii2-widgets
 * @subpackage yii2-widget-rating
 * @version 1.0.2
 */

namespace kartik\rating;

use kartik\base\InputWidget;
use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\base\TranslationTrait;

/**
 * StarRating widget is a wrapper widget for the Bootstrap Star Rating plugin by Krajee. This plugin is a simple star
 * rating yet powerful control that converts a  'number' input to a star rating control using JQuery. The widget is
 * styled for Bootstrap 3.0. Upgraded for the new plugin support. Includes fractional ratings with editable star
 * symbol, RTL inputs, and custom styling.
 *
 * @see http://plugins.krajee.com/star-rating
 * @see http://github.com/kartik-v/bootstrap-star-rating
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class StarRating extends InputWidget
{
    /**
     * @inheritdoc
     */
    public $pluginName = 'rating';

    /**
     * @var array the list of inbuilt themes
     */
    private static $_themes = ['krajee-fa', 'krajee-uni', 'krajee-svg'];

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->initLanguage();
        $this->registerAssets();
        if ($this->pluginLoading) {
            Html::addCssClass($this->options, 'rating-loading');
        }
        echo $this->getInput('textInput');
    }

    /**
     * Registers the needed assets
     */
    public function registerAssets()
    {
        $view = $this->getView();
        StarRatingAsset::register($view)->addLanguage($this->language, 'star-rating_locale_');
        $theme = ArrayHelper::getValue($this->pluginOptions, 'theme');
        if (!empty($theme) && in_array($theme, self::$_themes)) {
            StarRatingThemeAsset::register($view)->addTheme($theme);
        }
        $this->registerPlugin($this->pluginName);
    }
}
