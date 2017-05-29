<?php
namespace app\modules\backend\models;
use app\models\Content;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/5/29
 * Time: 12:17
 * Email:liyongsheng@meicai.cn
 */
class ContentCount
{
    /**
     *
     */
    public function getCountGroupByType()
    {
        Content::$currentType = null;
        $res = Content::find()->groupBy(['type'])->count();
        print_r($res);
    }
}