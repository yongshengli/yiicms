<?php

namespace app\models;

use app\components\AppActiveRecord;
use Codeception\Lib\Interfaces\ActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\db\Expression;
use yii\behaviors\AttributeBehavior;
/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property integer $category_id
 * @property string $image
 * @property string $description
 * @property \app\models\ContentDetail $detail
 * @property \app\models\Category $category
 * @property array $categories
 * @property integer $status
 * @property integer $admin_user_id
 * @property integer $hits
 * @property integer $created_at
 * @property integer $updated_at
 */
class Content extends AppActiveRecord
{
    /** 新闻 */
    const TYPE_NEWS = 1;
    /** 产品 */
    const TYPE_PRODUCTS =2;
    /** 下载 */
    const TYPE_DOWNLOADS =3;
    /** 照片相册 */
    const TYPE_PHOTOS =4;

    /** @var array  */
    static public $types = [
        self::TYPE_NEWS=>'新闻',
        self::TYPE_PRODUCTS=>'产品',
        self::TYPE_DOWNLOADS=>'下载',
        self::TYPE_PHOTOS=>'照片',
    ];

    /**
     * 自动更新详情
     * @var bool
     */
    public static $autoUpdateDetail = true;

    /**
     * 当前的类型
     */
    static $currentType = self::TYPE_NEWS;

    /** 前台不显示 */
    const STATUS_DISABLE = 0;

    /** 前台显示 */
    const STATUS_ENABLE = 1;

    /** @var array  */
    static public $statusList = [
        self::STATUS_DISABLE=>'未审核',
        self::STATUS_ENABLE=>'审核',
    ];

    /** @var  ContentDetail */
    protected $_detail;

    /**
     * 当前分类信息
     * @var
     */
    protected $_category;

    /** @var array 此类型下全部的分类 */
    protected static $_categories = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }

    public function init()
    {
        parent::init();
        $this->setAttribute('type', static::$currentType);
        //添加的时候设置 添加人id
        $this->attachBehavior('set_admin_user_id', [
            'class' => AttributeBehavior::className(),
            'attributes' => [
                static::EVENT_BEFORE_INSERT => 'admin_user_id',
            ],
            'value' => Yii::$app->user->id,
        ]);
    }
    public function load($data, $formName = null){
        $res = parent::load($data, $formName);
        if(static::$autoUpdateDetail && $res){
            return $this->getDetail()->load($data);
        }
        return $res;
    }
    /**
     * 类型常量对应的字符串常量
     * @var array
     */
    static public $typeStrings = [
        self::TYPE_NEWS=>'news',
        self::TYPE_PRODUCTS=>'products',
        self::TYPE_DOWNLOADS=>'downloads',
        self::TYPE_PHOTOS=>'photos',
    ];

    /**
     * 类型常量的字符串形式
     * @param $type
     * @param null $default
     * @return mixed|null
     */
    static public function type2String($type, $default=null)
    {
        return isset(self::$typeStrings[$type])?self::$typeStrings[$type]:$default;
    }
    public function getDetail()
    {
        if(empty($this->_detail)) {
            $this->_detail = $this->detail();
        }
        return $this->_detail;
    }
    /**
     * @return \app\models\ContentDetail|ActiveRecord|array
     */
    public function detail()
    {
        if ($this->isNewRecord) {
            return new ContentDetail();
        } else {
            return $this->hasOne(ContentDetail::className(), ['content_id' => 'id'])->one();
        }
    }

    /**
     * 只读属性
     * 获取 分类信息
     * @return static
     */
    public function getCategory()
    {
        if(empty($this->_category) || $this->_category->id!=$this->category_id){
            if($this->category_id){
                $this->_category = Category::findOne($this->category_id);
            }else{
                $this->_category = null;
            }
        }
        return $this->_category;
    }
    /**
     * 只读属性
     * 获取当前类型下的全部分类
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getCategories()
    {
        if(empty(static::$_categories)){
            static::$_categories = Category::find()->where(['type'=>static::$currentType])->asArray()->all();
        }
        return static::$_categories;
    }

    /**
     * 累加点击量
     * @param int $id
     * @return int
     */
    public static function hitCounters($id)
    {
        return self::updateAllCounters(['hits'=>1], ['id'=>$id]);
    }
    /**
     * 下一个
     */
    public function next()
    {
        return static::find()->where(['status'=>static::STATUS_ENABLE])->andWhere(['>','id', $this->id])
            ->orderBy('id asc')
            ->limit(1)
            ->one();
    }

    /**
     * 上一个
     */
    public function previous()
    {
        return static::find()->where(['status'=>static::STATUS_ENABLE])->andWhere(['<','id', $this->id])
            ->orderBy('id desc')
            ->limit(1)
            ->one();
    }

    /**
     * @param bool $runValidation
     * @param null $attributeNames
     * @return boolean whether the saving succeeded (i.e. no validation errors occurred).
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        $res = parent::save($runValidation, $attributeNames);
        if($res && static::$autoUpdateDetail) {
            if (empty($this->detail->content_id)) {
                $this->detail->content_id = $this->id;
            }
            if($this->detail->save()==false){
                $this->delete();
                return false;
            }
        }
        return $res;
    }

    public function validate($attributeNames = null, $clearErrors = true)
    {
        $res = parent::validate($attributeNames, $clearErrors);
        if(static::$autoUpdateDetail){
            $this->detail->content_id = 0; //临时设置
            return $this->detail->validate($attributeNames, $clearErrors);
        }
        return $res;
    }

    /**
     * 删除详情
     */
    public function afterDelete()
    {
        parent::afterDelete(); // TODO: Change the autogenerated stub
        $this->getDetail()->delete();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'type', 'status','category_id'], 'required'],
            [['type', 'status', 'admin_user_id', 'category_id','created_at', 'updated_at'], 'integer'],
            [['title', 'image', 'description', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * 内容类型
     * @return mixed|null
     */
    public function getTypeText()
    {
        return isset(self::$types[$this->type])?self::$types[$this->type]:null;
    }
    /**
     * 内容状态文字描述
     * return string|null
     */
    public function getStatusText()
    {
        return isset(self::$statusList[$this->status])?self::$statusList[$this->status]:null;
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
            'description' => 'Description',
            'keywords' => 'Keywords',
            'status' => '状态',
            'hits' => '点击数',
            'statusText' => '状态',
            'created_at'=>'创建时间'
        ];
    }
    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        ContentQuery::$type = static::$currentType;
        return Yii::createObject(ContentQuery::className(), [get_called_class()]);
    }
}

class ContentQuery extends ActiveQuery
{
    static $type = Content::TYPE_NEWS;

    public function init()
    {
        if(self::$type) {
            $this->andWhere(['type' => self::$type]);
        }else{
            $this->andFilterWhere(['in', 'type', array_keys(Content::$types)]);
        }
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