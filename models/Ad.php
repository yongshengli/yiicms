<?php

namespace app\models;

use Yii;
use app\components\AppActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "ad".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $link
 * @property integer $create_at
 * @property integer $update_at
 */
class Ad extends AppActiveRecord
{
    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ad';
    }
    public function beforeSave($runValidation = true)
    {
        if ($runValidation && !$this->validate()) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }
        $file = $this->uploadFile();
        if(empty($file) && empty($this->image)){
            return false;
        }
        if(!empty($file)) {
            $this->image = $file;
        }
        return true;
    }

    public function uploadFile()
    {
        /** @var UploadedFile imageFile */
        $this->imageFile = current(UploadedFile::getInstances($this, 'imageFile'));
        if(empty($this->imageFile)){
            $this->addError('imageFile','图片不能为空');
            return false;
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
        $path = '/uploads/ad-img/';
        if(!is_dir($rootPath.$path)){
            FileHelper::createDirectory($rootPath.$path);
        }
        return $path;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title',], 'required'],
            [['imageFile'], 'file', 'extensions' => 'gif, jpg, png, jpeg','mimeTypes' => 'image/jpeg, image/png',],
            [['create_at', 'update_at'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['image', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '名称',
            'image' => '图片',
            'imageFile' => '图片',
            'link' => '链接',
            'create_at' => '创建时间',
            'update_at' => '最后修改',
        ];
    }
}
