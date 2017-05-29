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
class  ContentCount
{
    /**
     * 获取分类内容数量统计
     */
    static public function getCountGroupByType()
    {
        Content::$currentType = null;
        $res = Content::find()->select('count(*) as num, type')->groupBy(['type'])->asArray()->all();
        foreach($res as &$item){
            $item['type_name']=Content::$types[$item['type']];
        }
        return $res;
    }
}