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
}
