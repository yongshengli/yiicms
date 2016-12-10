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
    /** @var array  */
    static public $types = [
        self::TYPE_NEWS=>'新闻',
        self::TYPE_PRODUCTS=>'产品',
        self::TYPE_PHOTO=>'照片',
    ];
    /** 前台不显示 */
    const STATUS_DISABLE = 0;
    /** 前台显示 */
    const STATUS_ENABLE = 1;

    /** @var array  */
    static public $statusList = [
        self::STATUS_DISABLE=>'不显示',
        self::STATUS_ENABLE=>'显示',
    ];

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
            [['title', 'type', 'status','category_id'], 'required'],
            [['type', 'status', 'admin_user_id', 'category_id','create_at', 'update_at'], 'integer'],
            [['title', 'image', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * 内容类型
     * @return mixed|null
     */
    public function getTypeText()
    {
        return isset(self::$types[$this->type])?self::$types[$this->type]:null;
    }

    /**
     * 内容状态文字描述
     * return string|null
     */
    public function getStatusText()
    {
        return isset(self::$statusList[$this->status])?self::$statusList[$this->status]:null;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'typeText'=>'类型',
            'image' => '图片',
            'description' => '描述',
            'status' => '状态',
            'statusText' => '状态',
            'create_at'=>'添加时间'
        ];
    }
}
