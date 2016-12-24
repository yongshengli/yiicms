<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/24
 * Time: 14:27
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class PhotosDetail extends ContentDetail
{

    public $imageFile;

    /**
     * 保存照片
     * @return bool
     */
    public function uploadFile()
    {
        /** @var UploadedFile imageFile */
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if(empty($this->imageFile)){
            $this->addError('imageFile', '图片不能为空');
            return false;
        }
        $fileName = $this->createUploadFilePath().uniqid('img_').'.'. $this->imageFile->extension;

        if($this->imageFile->saveAs(\Yii::getAlias('@webroot').$fileName)){
            $this->file_url = $fileName;
        }
        return $this->save();
    }
    /**
     *
     * @return string
     */
    public function createUploadFilePath()
    {
        $rootPath = \Yii::getAlias('@webroot');
        $path = '/uploads/photos/'.$this->content_id;
        if(!is_dir($rootPath.$path)){
            FileHelper::createDirectory($rootPath.$path);
        }
        return $path;
    }
    public function scenarios()
    {
        return parent::scenarios();
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'file_url'], 'required'],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content_id'=>'相册ID',
            'detail' => '照片描述',
            'file_url' => '照片地址',
        ];
    }
}