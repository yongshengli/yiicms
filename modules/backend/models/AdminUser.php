<?php

namespace app\modules\backend\models;
use app\components\AppActiveRecord;

use Yii;

/**
 * This is the model class for table "admin_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $access_token
 * @property integer $created_at
 * @property integer $updated_at
 */
class AdminUser extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user';
    }

    public function load($data, $formName = null)
    {
        if(parent::load($data, $formName)) {
            $this->resetPassword();
            return true;
        }
        return false;
    }

    public function resetPassword()
    {
        if(empty($this->password_hash)){
            $this->setAttribute('password_hash', $this->getOldAttribute('password_hash'));
        }else{
            $this->setAttribute('password_hash' ,self::createPassword($this->password_hash));
        }
    }
    /**
     * Validates password
     *
     * @param string $password user current password
     * @param string $postPassword http post password
     * @return bool if password provided is valid for current user
     */
    public static function validatePassword($postPassword, $password)
    {
        return self::createPassword($postPassword) === $password;
    }

    /**
     * @param string $password
     * @return string
     */
    public static function createPassword($password)
    {
        return md5($password);
    }

    /**
     * 获取当前密码强度等级
     * 从高到低依次为 5, 4, 3, 2, 1, 0
     * @param string $str
     * @return int
     */
    public static function getPwdLevel($str){
        $strModel = 0;
        $level = 0;
        $pwdLength = strlen($str);
        for($i=0; $i<$pwdLength; $i++){
            $charCode = ord($str{$i});
            if ($charCode >= 48 && $charCode <= 57) //数字
                $charMode = 1;
            else if ($charCode >= 65 && $charCode <= 90) //大写
                $charMode = 2;
            else if ($charCode >= 97 && $charCode <= 122) //小写
                $charMode = 4;
            else
                $charMode = 8;
            $strModel |= $charMode;
        }
        for($i=0; $i<4; $i++){
            if($strModel & 1){
                $level ++;
            }
            $strModel >>= 1;
        }
        if($pwdLength<6){
            $level --;
        }elseif($pwdLength>8){
            $level ++;
        }
        $level = max($level, 0);
        $level = min($level, 5);
        return $level;
    }
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';


    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['username', 'password_hash', 'email'];
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'email', 'password_hash'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'updated_at'],'required'],

            [['updated_at'], 'required', 'on'=>'update'],

            [['password', 'created_at', 'updated_at'], 'required', 'on'=>'create'],

            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'access_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => '密码',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => '状态',
            'access_token' => 'Access Token',
            'created_at' => '创建时间',
            'updated_at' => '最后修改',
        ];
    }
}
