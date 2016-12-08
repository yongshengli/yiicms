<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/8
 * Time: 15:54
 * Email:liyongsheng@meicai.cn
 */
namespace app\modules\backend\models;
use yii\base\Model;

class ContentForm extends Model
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'status', 'admin_user_id', 'create_at', 'update_at'], 'integer'],
            [['title', 'image', 'description'], 'string', 'max' => 255],
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
            'type' => 'Type',
            'image' => 'Image',
            'description' => 'Description',
            'status' => 'Status',
            'admin_user_id' => 'Admin User ID',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }
}