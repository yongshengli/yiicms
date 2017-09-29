<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/9/29
 * Time: 14:05
 * Email:liyongsheng@meicai.cn
 */

namespace app\themes\tradition;

use yii\web\AssetBundle;

/**
 * Class Theme
 * @package app\themes
 */
class Theme extends AssetBundle
{
    public $sourcePath = '@app/themes/tradition/assets';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css'
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
    ];

    /**
     * 主题名称
     * @return string
     */
    public static function themeName(){
        return '传统企业站风格';
    }
}