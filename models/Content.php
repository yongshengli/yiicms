<?php

namespace app\models;

use app\components\AppActiveRecord;
use Yii;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property string $image
 * @property string $description
 * @property integer $status
 * @property integer $admin_user_id
 * @property integer $create_at
 * @property integer $update_at
 */
class Content extends AppActiveRecord
{
    /** 新闻 */
    const TYPE_NEWS = 1;
    /** 产品 */
    const TYPE_PRODUCTS =2;
    /** 照片 */
    const TYPE_PHOTO =3;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type'], 'required'],
            [['type', 'status', 'admin_user_id', 'create_at', 'update_at'], 'integer'],
            [['title', 'image', 'description'], 'string', 'max' => 255],
        ];
    }
    /**
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function insert($runValidation = true, $attributeNames = null)
    {
        $this->admin_user_id = Yii::$app->user->id;
        return parent::insert($runValidation, $attributeNames);
    }
}
