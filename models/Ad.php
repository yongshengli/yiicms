<?php

namespace app\models;

use yii\db\Expression;
use Yii;
use app\components\AppActiveRecord;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
use yii\db\ActiveQuery;
/**
 * This is the model class for table "ad".
 *
 * @property integer $id
 * @property string $title
 * @property string $image
 * @property string $link partner
 * @property integer $created_at
 * @property integer $updated_at
 */
class Ad extends AppActiveRecord
{
    /**
     * 轮播图
     */
    const TYPE_CAROUSEL =101;
    /**
     * 友情链接
     */
    const TYPE_BLOGROLL =102;

    /**
     * 当前类型
     * @var int
     */
    static $currentType = self::TYPE_CAROUSEL;

    static $types = [
        self::TYPE_CAROUSEL=>'轮播图',
        self::TYPE_BLOGROLL=>'友情链接',
    ];
    /** @var UploadedFile imageFile */
    public $imageFile;

    public function init()
    {
        parent::init();
        $this->setAttribute('type', static::$currentType);
    }
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
            $this->addError('imageFile','图片不能为空');
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
            [['created_at', 'updated_at'], 'integer'],
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
            'created_at' => '创建时间',
            'updated_at' => '最后修改',
        ];
    }
    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        AdQuery::$type = static::$currentType;
        return Yii::createObject(AdQuery::class, [get_called_class()]);
    }
}

class AdQuery extends ActiveQuery
{
    static $type = Ad::TYPE_CAROUSEL;

    public function init()
    {
        $this->andWhere(['type' => self::$type]);
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
