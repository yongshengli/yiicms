<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/9
 * Time: 10:17
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\Expression;
use Yii;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class Downloads extends News
{

    public function init()
    {
        parent::init();
        $this->setAttribute('type', static::TYPE_DOWNLOADS);
    }
    /** @var  UploadedFile */
    public $file;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'status','category_id',], 'required'],
            [['file'], 'file', 'extensions' => 'zip,rar',],
            [['type', 'status', 'admin_user_id', 'category_id','create_at', 'update_at'], 'integer'],
            [['title', 'image', 'description'], 'string', 'max' => 255],
        ];
    }
    /**
     * 获取全部的新闻分类
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategorys()
    {
        return Category::find()->where(['type'=>self::TYPE_DOWNLOADS])->all();
    }

    public function beforeSave($runValidation = true)
    {
        if ($runValidation && !$this->validate()) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }
        $file = $this->uploadFile();
        if($file){
            $this->detail->file_url = $file;
        }
        if(empty($this->detail->file_url)){
            $this->addError('file', '文件能为空');
            return false;
        }
        return true;
    }

    public function uploadFile()
    {
        /** @var UploadedFile imageFile */
        $this->file = current(UploadedFile::getInstances($this, 'file'));
        if(empty($this->file)){
            return '';
        }
        $fileName = $this->createUploadFilePath().uniqid('yiicms').'.'. $this->file->extension;

        if($this->file->saveAs(\Yii::getAlias('@webroot').$fileName)){
            return $fileName;
        }
        return '';
    }

    public function createUploadFilePath()
    {
        $rootPath = \Yii::getAlias('@webroot');
        $path = '/uploads/downloads/';
        if(!is_dir($rootPath.$path)){
            FileHelper::createDirectory($rootPath.$path);
        }
        return $path;
    }
    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        return Yii::createObject(DownloadsQuery::className(), [get_called_class()]);
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
            'file_url' => '文件路径',
            'file' => '文件',
            'description' => '描述',
            'status' => '状态',
            'statusText' => '状态',
            'create_at'=>'创建时间'
        ];
    }
}


class DownloadsQuery extends ActiveQuery
{
    public function init()
    {
        $this->andWhere(['type'=>Content::TYPE_DOWNLOADS]);
        return $this;
    }
    /**
     * Sets the WHERE part of the query.
     *
     * The method requires a `$condition` parameter, and optionally a `$params` parameter
     * specifying the values to be bound to the query.
     *
     * The `$condition` parameter should be either a string (e.g. `'id=1'`) or an array.
     *
     * @inheritdoc
     *
     * @param string|array|Expression $condition the conditions that should be put in the WHERE part.
     * @param array $params the parameters (name => value) to be bound to the query.
     * @return $this the query object itself
     * @see andWhere()
     * @see orWhere()
     * @see QueryInterface::where()
     */
    public function where($condition, $params = [])
    {
        parent::andWhere($condition, $params);
        return $this;
    }
}