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
    static $autoUpdateDetail = false;
    /**
     * @return array
     */
    public function detail()
    {
        if ($this->isNewRecord) {
            return [];
        } else {
            return $this->hasMany(ContentDetail::class, ['content_id' => 'id'])->all();
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
            'hits' => '点击数',
            'created_at'=>'创建时间'
        ];
    }
}