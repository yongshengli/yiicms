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

/**
 * Class PhotosDetail
 * @package app\models
 */
class PhotosDetail extends ContentDetail
{
    /** @var $imageFile  UploadedFile */
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
        try {
            $fileName = $this->createUploadFilePath() . uniqid('img_') . '.' . $this->imageFile->extension;
        }catch(\Exception $e){
            $this->addError('imageFile', $e->getMessage());
            return false;
        }
        if($this->imageFile->saveAs(\Yii::getAlias('@webroot').$fileName)){
            $this->file_url = $fileName;
        }
        if($this->save()){
            //如果相册没有封面那么就把当前照片设为封面
            if(empty($this->content->image)){
                return $this->setCover();
            }
            return true;
        }else{
            return false;
        }
    }
    /**
     * @throw \Exception
     * @return string
     */
    public function createUploadFilePath()
    {
        $rootPath = \Yii::getAlias('@webroot');
        $path = '/uploads/photos/'.$this->content_id.'/';
        if(!is_dir($rootPath.$path)){
            FileHelper::createDirectory($rootPath.$path);
        }
        return $path;
    }

    /**
     * 把当前照片设为封面
     */
    public function setCover()
    {
        $this->getContent()->image = $this->file_url;
        return $this->getContent()->save();
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content_id', 'file_url'], 'required'],
            ['detail','string']
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
            'imageFile'=>'上传图片',
            'file_url' => '照片地址',
        ];
    }

    /**
     * @return \app\models\Content
     */
    public function content()
    {
        if ($this->isNewRecord) {
            return new Photos();
        } else {
            return $this->hasOne(Photos::class, ['id' => 'content_id'])->one();
        }

    }
}