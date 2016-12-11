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
use yii\db\ActiveQuery;
use yii\db\Expression;

class Products extends Content
{

    public function init()
    {
        $this->setAttribute('type', self::TYPE_PRODUCTS);
        parent::init();
    }
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
     * @return \yii\db\ActiveQuery | \app\models\ContentDetail
     */
    public function getDetail()
    {
        if($this->isNewRecord){
            return new ContentDetail();
        }else{
            return $this->hasOne(ContentDetail::class, ['content_id'=>'id']);
        }
    }

    /**
     * 获取全部的新闻分类
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategorys()
    {
        return Category::find()->where(['type'=>self::TYPE_PRODUCTS])->all();
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
        $path = '/upload/products-img/';
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
        return Yii::createObject(ProductQuery::className(), [get_called_class()]);
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

class ProductQuery extends ActiveQuery
{
    public function init()
    {
        $this->andWhere(['type'=>Content::TYPE_PRODUCTS]);
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