<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/9
 * Time: 10:17
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;

use app\components\behaviors\UploadBehavior;
use Yii;

/**
 * Class Products
 * @package app\models
 * @method uploadImgFile()
 */
class Products extends Content
{
    static $currentType = Parent::TYPE_PRODUCTS;

    public $imageFile;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'status','category_id'], 'required'],
            [['imageFile'], 'file', 'extensions' => 'gif, jpg, png, jpeg','mimeTypes' => 'image/jpeg, image/png',],
            [['type', 'status', 'admin_user_id', 'category_id','created_at', 'updated_at'], 'integer'],
            [['title', 'image', 'description'], 'string', 'max' => 255],
        ];
    }
    /**
     * @return \app\models\ContentDetail
     */
    public function detail()
    {
        if ($this->isNewRecord) {
            return new ContentDetail(['scenario' => ContentDetail::SCENARIO_PRODUCTS]);
        } else {
            $model = $this->hasOne(ContentDetail::className(), ['content_id' => 'id'])->one();
            $model->scenario = ContentDetail::SCENARIO_PRODUCTS;
            return $model;
        }
    }

    public function beforeSave($insert)
    {
        $res = parent::beforeSave($insert);
        if($res==false){
            return $res;
        }
        if (!$this->validate()) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }
        $file = $this->uploadImgFile();
        if($file){
            $this->image = $file;
        }
        return true;
    }

    public function behaviors()
    {
        return [
            [
                'class'=>UploadBehavior::className(),
                'saveDir'=>'products-img/'
            ]
        ];
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
            'category_id'=>'分类',
            'image' => '图片',
            'imageFile' => '图片',
            'keywords' => 'Keywords',
            'description' => 'Description',
            'status' => '状态',
            'statusText' => '状态',
            'hits' => '点击数',
            'created_at'=>'创建时间'
        ];
    }
}