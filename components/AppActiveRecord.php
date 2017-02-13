<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/8
 * Time: 16:39
 * Email:liyongsheng@meicai.cn
 */

namespace app\components;
use \yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Class AppActiveRecord
 * @package app\components
 * @property integer $created_at
 * @property integer $updated_at
 */
class AppActiveRecord extends ActiveRecord
{
    public function init(){
        parent::init();
        $this->attachBehaviors([
                TimestampBehavior::className(),
            ]
        );
    }

    /**
     * 创建时间
     * @return array|false|int
     */
    public function getCreatedAt()
    {
        if(empty($this->created_at)){
            return null;
        }
        $createAt = is_string($this->created_at)?strtotime($this->created_at):$this->created_at;
        if(date('H:i:s', $createAt)=='00:00:00'){
            return [$createAt, $createAt+3600*24];
        }
        return $createAt;
    }
}