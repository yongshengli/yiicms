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
            [['title'], 'required'],
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
            'title' => '标题',
            'type' => '类型',
            'image' => '图片',
            'description' => '描述',
            'status' => '状态',
            'admin_user_id' => 'Admin User ID',
            'create_at' => '添加时间',
            'update_at' => '最后修改',
        ];
    }

}