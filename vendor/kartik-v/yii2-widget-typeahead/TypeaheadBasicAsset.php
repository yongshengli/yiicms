<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2015
 * @package yii2-widgets
 * @subpackage yii2-widget-typeahead
 * @version 1.0.1
 */

namespace kartik\typeahead;

/**
 * Asset bundle for Typeahead Widget (Basic)
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class TypeaheadBasicAsset extends \kartik\base\AssetBundle
{

    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/typeahead', 'css/typeahead-kv']);
        $this->setupAssets('js', ['js/typeahead.jquery', 'js/typeahead-kv']);
        parent::init();
    }
}
