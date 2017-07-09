<?php

namespace app\models;
use app\components\AppActiveRecord;
use Yii;
use app\models\Content;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use app\components\behaviors\UploadBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property string $path
 * @property string $image
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 * @property array $types
 * @method uploadImgFile()
 * @const TYPE_NEWS \app\models\Content::TYPE_NEWS
 * @const TYPE_PRODUCTS \app\models\Content::TYPE_PRODUCTS
 * @const TYPE_PHOTO \app\models\Content::TYPE_PHOTO
 */
class Category extends AppActiveRecord
{

    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }
    /**
     * 获取可能的全部父类
     */
    public function getPossibleParentArr()
    {
        $list = self::find()
            ->where(['type'=>$this->type])
            ->andFilterWhere(['<>', 'id', $this->id])
            ->asArray()
            ->all();
        array_unshift($list, self::$topCategory);
//        print_r($list);
        return $list;
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $res = parent::beforeSave($insert);
        if($res==false){
            return $res;
        }
        if (!$this->validate()) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }
        $file = $this->uploadImgFile();
        if($file){
            $this->image = $file;
        }
        if($this->isNewRecord || $this->isAttributeChanged('pid', false)) {
            $parent = $this->getParent();
            if ($parent instanceof static) {
                $this->path = trim(trim($parent->path, '/') . '/' . $parent->id, '/');
            } else {
                $this->path = '';
            }
            if(!empty($this->oldAttributes['path'])) {
                $path = $this->oldAttributes['path'] . '/' . $this->id;
            }else{
                $path = $this->id;
            }
            $this->editAllPath($path, $this->path);
        }
        return true;
    }

    /**
     * 批量替换path
     * @param string $path
     * @param string $newPath
     * @return bool
     */
    protected function editAllPath($path, $newPath){
        $children = Category::find()->where(['REGEXP', 'path', '^' . $path . '(/|$)'])->all();
        if ($children) {
            /** @var Category $child */
            foreach ($children as $child) {
                $child->path = trim(preg_replace('#^' . $path . '(\/|$)(.*)#', $newPath.'/$2', $child->path),'/');
                $child->save();
            }
        }
        return true;
    }
    /**
     * 获取完整的父类名称
     * @return null|string
     */
    public function getFullParentName()
    {
        if(empty($this->path)){
            return null;
        }
        $list = ArrayHelper::toArray($this->getFullParent());
        return implode('/',array_column($list, 'name'));
    }

    /**
     * 顶级分类信息
     * @var array $topCategory
     */
    static public $topCategory = [
        'id'=>0,
        'name'=>'作为一级分类',
        'pid'=>null,
        'path'=>'',
        'image'=>'',
    ];

    /**
     * 获取完整的分类名称
     * @return string
     */
    public function getFullName()
    {
        $baseName = $this->getFullParentName();
        return $baseName?$baseName.'/'.$this->name:$this->name;
    }
    /** @var  array */
    private $_parents;
    /**
     * 获取全部完整父类
     */
    public function getFullParent()
    {
        if(empty($this->path)){
            return null;
        }
        if(empty($this->_parents['fullParent']) || empty($this->_parents['path']) || $this->_parents['path']!=$this->path){
            $pids = explode('/',$this->path);
            $this->_parents['fullParent'] = self::find()->andFilterWhere(['in', 'id', $pids])->orderBy('path')->all();
            if($this->_parents['fullParent']) {
                $this->_parents['parent'] = end($this->_parents['fullParent']);
            }
        }
        return $this->_parents['fullParent'];
    }

    /**
     * 获取父类名称
     * @return array
     */
    public function getParentName()
    {
        if(empty($this->pid)){
            return self::$topCategory['name'];
        }
        $category = $this->getParent();

        return empty($category)?null:$category['name'];
    }

    /**
     * 获取父类
     * @return static|array
     */
    public function getParent()
    {
        if(empty($this->pid)){
            return self::$topCategory;
        }
        if(empty($this->_parents['parent']) || $this->_parents['parent']->id!=$this->pid){
            $this->_parents['parent'] = self::findOne($this->pid);
        }
        return $this->_parents['parent'];
    }
    public function behaviors()
    {
        return [
            [
                'class'=>UploadBehavior::className(),
                'saveDir'=>'products-img/'
            ]
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','pid', 'type'], 'required'],
            [['pid', 'type'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['image','description', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '分类名',
            'fullName' => '完整分类名',
            'pid' => '父类',
            'type' => '分类类型',
            'image' => '图片',
            'imageFile' => '图片',
            'description' => '描述',
            'keywords' => 'Keywords',
            'created_at' => '创建时间',
            'updated_at' => '最后修改',
        ];
    }

    /**
     * 分类类型
     * @return array
     */
    public static function getTypes()
    {
        return ArrayHelper::merge(Content::$types, Ad::$types);
    }

    /**
     * 类型文字
     * @return mixed|null
     */
    public function getTypeText()
    {
        $types =  self::getTypes();
        return isset($types[$this->type])?$types[$this->type]:null;
    }
}
