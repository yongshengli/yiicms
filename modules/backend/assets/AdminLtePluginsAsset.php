<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/2/16
 * Time: 16:38
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\assets;
use yii\web\AssetBundle;

class AdminLtePluginsAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $js = [
//        'datatables/dataTables.bootstrap.min.js',
        // more plugin Js here
    ];
    public $css = [
//        'datatables/dataTables.bootstrap.css',
        // more plugin CSS here
    ];
    public $depends = [
        'dmstr\web\AdminLteAsset',
    ];
}