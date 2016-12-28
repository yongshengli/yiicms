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
