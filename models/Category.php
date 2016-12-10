<?php

namespace app\models;
use app\components\AppActiveRecord;
use Yii;
use app\models\Content;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property integer $type
 * @property integer $create_at
 * @property integer $update_at
 * @property array $types
 *
 * @const TYPE_NEWS \app\models\Content::TYPE_NEWS
 * @const TYPE_PRODUCTS \app\models\Content::TYPE_PRODUCTS
 * @const TYPE_PHOTO \app\models\Content::TYPE_PHOTO
 */
class Category extends AppActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }
    /**
     * 顶级分类信息
     * @var array
     */
    static public $topCategory = [
        'id'=>0,
        'name'=>'顶级分类',
        'pid'=>null,
    ];
    /**
     * 获取可能的全部父类
     */
    public function getPossibleParents()
    {
        $list = self::find()
            ->where(['type'=>$this->type])
            ->andWhere(['<>', 'id', $this->id])
            ->all();
        array_unshift($list, self::$topCategory);
//        print_r($list);
        return $list;
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
        return self::findOne($this->pid);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pid', 'type', 'create_at', 'update_at'], 'required'],
            [['pid', 'type', 'create_at', 'update_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
            'pid' => '父类',
            'type' => '分类类型',
            'create_at' => '创建时间',
            'update_at' => '最后修改',
        ];
    }

    /**
     * 分类类型
     * @return array
     */
    public function getTypes()
    {
        return Content::$types;
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
