<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/2/16
 * Time: 16:38
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\assets;
use dmstr\web\AdminLteAsset as BaseAdminLteAsset;

class AdminLteAsset extends BaseAdminLteAsset
{
    public $js = [
        'js/app.min.js',
        'plugins/slimScroll/jquery.slimscroll.min.js'
    ];
}