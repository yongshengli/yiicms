<?php

namespace app\models;

use app\components\AppActiveRecord;
use Yii;
/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $name
 * @property string $label
 * @property string $value
 * @property integer $created_at
 * @property integer $updated_at
 */
class Config extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * 全部配置包含缓存
     * @param int $duration
     * @return mixed
     */
    public static function allConfig($duration = 3600)
    {
        return Config::getDb()->cache(function () {
            $res = Config::find()->all();
            if(!empty($res)){
                $result = [];
                foreach($res as &$item){
                    $result[$item['name']] = $item;
                }
                $res = &$result;
            }
            return $res;
        }, $duration);
    }

    /**
     * 获取指定配置
     * @param string $name
     * @return null
     */
    public static function getByName($name)
    {
        $config = self::allConfig();
        return isset($config[$name])?$config[$name]:null;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'label', 'value'], 'required'],
            ['name', 'string', 'max' => 20],
            ['label', 'string', 'max' => 50],
            ['value', 'string', 'max' => 3000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '配置字段',
            'label' => '配置字段名',
            'value' => '配置值',
            'created_at' => '创建时间',
            'updated_at' => '最后修改',
        ];
    }
}
