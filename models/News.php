<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/9
 * Time: 10:17
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;

class News extends Content
{

    /**
     * @return \yii\db\ActiveQuery | \app\models\ContentDetail
     */
    public function getDetail()
    {
        if($this->isNewRecord){
            return new ContentDetail();
        }else{
            return $this->hasOne(ContentDetail::class, ['content_id'=>'id']);
        }
    }

    /**
     * 获取全部的新闻分类
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategorys()
    {
        return Category::find()->where(['type'=>self::TYPE_NEWS])->all();
    }
    /**
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function insert($runValidation = true, $attributeNames = null)
    {
        $this->type = static::TYPE_NEWS;
        return parent::insert($runValidation, $attributeNames);
    }
}