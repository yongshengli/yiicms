<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/24
 * Time: 13:42
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;


class Photos extends Content
{
    static $currentType = Content::TYPE_PHOTOS;

    /**
     * @return array
     */
    public function detail()
    {
        if ($this->isNewRecord) {
            return [];
        } else {
            $model = $this->hasMany(ContentDetail::class, ['content_id' => 'id'])->all();
            $model->scenario = ContentDetail::SCENARIO_PHOTOS;
            return $model;
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '相册名称',
            'typeText'=>'类型',
            'category_id'=>'分类',
            'image' => '相册封面',
            'imageFile' => '相册封面',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'status' => '状态',
            'statusText' => '状态',
            'create_at'=>'创建时间'
        ];
    }
}