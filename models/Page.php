<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property integer $title
 * @property string $image
 * @property string $description
 * @property string $keyword
 * @property string $template
 * @property integer $content
 * @property array $templates
 */
class Page extends \app\components\AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['title', 'keyword', 'template'], 'string', 'max' => 100],
            ['content','string', 'max'=>5000]
        ];
    }

    /**
     * 获取模板
     * @return array
     */
    public function getTemplates()
    {
        return [
//            'about'=>'about',
            'page'=>'page',
//            'index'=>'index',
            'contact'=>'contact',
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
            'description' => '描述',
            'keyword' => 'Keyword',
            'template' => '模板',
            'content' => '内容',
            'created_at' => '创建时间',
            'updated_at' => '最后修改',
        ];
    }
}
