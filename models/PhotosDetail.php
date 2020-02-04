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
use yii\db\ActiveRecord;
use app\components\behaviors\UploadBehavior;
/**
 * Class PhotosDetail
 * @package app\models
 * @method createUploadFilePath()
 * @method uploadImgFile()
 */
class PhotosDetail extends ContentDetail
{
    /**
     * 保存照片
     * @return bool
     */
    public function uploadPhoto()
    {
        $this->file_url = $this->uploadImgFile();
        if(empty($this->file_url)){
            $this->addError('imageFile', '图片不能为空');
            return false;
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

    public function behaviors()
    {
        return [
            [
                'class'=>UploadBehavior::className(),
                'saveDir'=>'photos/'
            ]
        ];
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
     * @return ActiveRecord
     */
    public function content()
    {
        if ($this->isNewRecord) {
            return new Photos();
        } else {
            return $this->hasOne(Photos::className(), ['id' => 'content_id'])->one();
        }

    }
}