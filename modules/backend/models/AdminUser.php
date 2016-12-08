<?php

namespace app\modules\backend\models;
use app\components\AppActiveRecord;
use yii\web\IdentityInterface;

/**
 * 后台管理员
 * Class AdminUser
 * @package app\modules\backend\models
 */
class AdminUser extends AppActiveRecord implements IdentityInterface
{

    static function tableName(){
        return 'admin_user';
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        if(empty($id)){
            return null;
        }
        return self::find()->where(['id'=>$id])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::find()->where(['access_token'=>$token])->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return self|null|array
     */
    public static function findByUsername($username)
    {
        if(empty($username)){
            return null;
        }
        return static::find()->where(['username'=>$username])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
