<?php

namespace app\modules\backend\models;
use mdm\admin\models\User;
/**
 * 后台管理员
 * Class AdminUser
 * @package app\modules\backend\models
 */
class AdminUserIdentity extends User
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin_user';
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return AdminUser::validatePassword($password, $this->password_hash);
    }
}
