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
    public $sourcePath = '@vendor/almasaeed2010/adminlte/';
    public $js = [
        'plugins/slimScroll/jquery.slimscroll.min.js',
    ];
}