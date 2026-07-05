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
use yii\web\BadRequestHttpException;
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

    public static function getErrorMsg($error){
        $errorMap = [
            1=>'上传文件超过了php.ini中的upload_max_filesize配置'.ini_get('upload_max_filesize'),
            2=>'上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值',
            3=>'文件只有部分被上传',
            4=>'没有文件被上传',
            6=>'找不到临时文件夹',
            7=>'文件写入失败',
        ];
        return isset($errorMap[$error])?$errorMap[$error]:'未知的上传错误';
    }

    /**
     * 上传图片
     * @return bool|string
     * @throws BadRequestHttpException
     */
    public function uploadImgFile()
    {
        /** @var UploadedFile imageFile */
        $this->imageFile = UploadedFile::getInstance($this->owner, 'imageFile');
        if(empty($this->imageFile)){
            return '';
        }
        if($this->imageFile->hasError){
            throw new BadRequestHttpException(self::getErrorMsg($this->imageFile->error));
        }
        // MIME 白名单校验，防止伪造扩展名
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $mime = FileHelper::getMimeType($this->imageFile->tempName);
        if (!in_array($mime, $allowedMimes)) {
            throw new BadRequestHttpException('不允许的文件类型');
        }
        $ext = $this->imageFile->extension ?: 'jpg';
        $fileName = $this->createUploadFilePath() . uniqid('img_') . '.' . $ext;
        if($this->imageFile->saveAs(\Yii::getAlias('@webroot').$fileName)){
            return $fileName;
        }
        return '';
    }

    /**
     * 上传文件
     * @return string
     * @throws BadRequestHttpException
     */
    public function uploadFile()
    {
        /** @var UploadedFile file */
        $this->file = UploadedFile::getInstance($this->owner, 'file');
        if(empty($this->file)){
            return '';
        }
        if($this->file->hasError){
            throw new BadRequestHttpException(self::getErrorMsg($this->file->error));
        }
        $ext = $this->file->extension ?: 'dat';
        $fileName = $this->createUploadFilePath() . uniqid('yiicms') . '.' . $ext;
        if ($this->file->saveAs(\Yii::getAlias('@webroot') . $fileName)) {
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
