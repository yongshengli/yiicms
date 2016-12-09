<?php

namespace app\models;

use app\components\AppActiveRecord;

/**
 * This is the model class for table "content_detail".
 *
 * @property integer $id
 * @property integer $content_id
 * @property integer $detail
 */
class ContentDetail extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content_detail';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'detail'], 'required'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id'=>'主表ID不能为空',
            'detail' => '内容',
        ];
    }
}
