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
 * @property integer $created_at
 * @property integer $update_at
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
            [['title', 'content', 'created_at', 'update_at'], 'required'],
            [['title', 'content', 'created_at', 'update_at'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['keyword', 'template'], 'string', 'max' => 100],
        ];
    }

    public function getTemplates()
    {
        return [
            'about',
            'page',
            'index',
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'keyword' => 'Keyword',
            'template' => 'Template',
            'content' => 'Content',
            'created_at' => 'Created At',
            'update_at' => 'Update At',
        ];
    }
}
