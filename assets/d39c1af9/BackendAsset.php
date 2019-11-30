<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class BackendAsset extends AssetBundle
{
    public $sourcePath ='@app/modules/backend/assets/';
    public $baseUrl = '@web';
    public $css = [
//        'backend.css',
    ];
    public $js = [
        'jquery.slimscroll.js',
        'skin.js',
        'backend.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'dmstr\web\AdminLteAsset',
//        'mdm\admin\AutocompleteAsset',
        'app\modules\backend\assets\AdminLtePluginsAsset',
    ];
}
