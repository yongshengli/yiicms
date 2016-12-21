<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/9
 * Time: 10:17
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;

use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use Yii;

class Products extends Content
{
    const CURRENT_TYPE = Parent::TYPE_PRODUCTS;

    public $imageFile;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'status','category_id'], 'required'],
            [['imageFile'], 'file', 'extensions' => 'gif, jpg, png, jpeg','mimeTypes' => 'image/jpeg, image/png',],
            [['type', 'status', 'admin_user_id', 'category_id','create_at', 'update_at'], 'integer'],
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
            $model = $this->hasOne(ContentDetail::class, ['content_id' => 'id'])->one();
            $model->scenario = ContentDetail::SCENARIO_PRODUCTS;
            return $model;
        }
    }

    public function beforeSave($runValidation = true)
    {
        if ($runValidation && !$this->validate()) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }
        $file = $this->uploadFile();
        if($file){
            $this->image = $file;
        }
        return true;
    }

    public function uploadFile()
    {
        /** @var UploadedFile imageFile */
        $this->imageFile = current(UploadedFile::getInstances($this, 'imageFile'));
        if(empty($this->imageFile)){
            return '';
        }
        $fileName = $this->createUploadFilePath().uniqid('img_').'.'. $this->imageFile->extension;

        if($this->imageFile->saveAs(\Yii::getAlias('@webroot').$fileName)){
            return $fileName;
        }
        return '';
    }

    public function createUploadFilePath()
    {
        $rootPath = \Yii::getAlias('@webroot');
        $path = '/uploads/products-img/';
        if(!is_dir($rootPath.$path)){
            FileHelper::createDirectory($rootPath.$path);
        }
        return $path;
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
            'description' => '描述',
            'status' => '状态',
            'statusText' => '状态',
            'create_at'=>'创建时间'
        ];
    }
}