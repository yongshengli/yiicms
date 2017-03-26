<?php

/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/2/13
 * Time: 14:13
 * Email:liyongsheng@meicai.cn
 */
namespace app\components\behaviors;

use app\components\AppActiveRecord;
use yii\base\Behavior;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * Class UploadBehavior
 * @package app\components\behaviors
 * @property AppActiveRecord $owner
 */
class UploadBehavior extends Behavior
{
    /** @var string  */
    public $saveDir = '';

    public $imageFile;

    public $file;
    /**
     * 上传图片
     * @return bool|string
     */
    public function uploadImgFile()
    {
        /** @var UploadedFile imageFile */
        $this->imageFile = current(UploadedFile::getInstances($this->owner, 'imageFile'));
        if(empty($this->imageFile)){
            return '';
        }
        try {
            $fileName = $this->createUploadFilePath() . uniqid('img_') . '.' . $this->imageFile->extension;
        } catch (\Exception $e) {
            $this->owner->addError('imageFile', $e->getMessage());
            return false;
        }
        if($this->imageFile->saveAs(\Yii::getAlias('@webroot').$fileName)){
            return $fileName;
        }
        return '';
    }

    /**
     * 上传文件
     * @return string
     */
    public function uploadFile()
    {
        /** @var UploadedFile file */
        $this->file = current(UploadedFile::getInstances($this->owner, 'file'));
        if(empty($this->file)){
            return '';
        }
        $fileName = $this->createUploadFilePath().uniqid('yiicms').'.'. $this->file->extension;

        if($this->file->saveAs(\Yii::getAlias('@webroot').$fileName)){
            return $fileName;
        }
        return '';
    }
    /**
     * 创建文件夹
     * @return string
     */
    public function createUploadFilePath()
    {
        $rootPath = \Yii::getAlias('@webroot');
        $path = rtrim('/uploads/'.$this->saveDir, '/').'/';
        if(!is_dir($rootPath.$path)){
            FileHelper::createDirectory($rootPath.$path, 0777);
        }
        return $path;
    }
}