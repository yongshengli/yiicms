<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/9
 * Time: 17:19
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\models;

use yii\base\Model;
use Yii;

class EditPasswordForm extends Model
{
    public $password;
    public $newPassword;
    public $passwordRepeat;

    /** @var  AdminUser */
    public $user;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password','newPassword','passwordRepeat'], 'required'],
            ['passwordRepeat', 'compare', 'compareAttribute'=>'newPassword'],
            // rememberMe must be a boolean value
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->user;
            if (!$user || !$user::validatePassword($this->password, $user->password_hash)) {
                $this->addError($attribute, '密码错误');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function saveEdit()
    {
        if(!($this->user instanceof AdminUser)){
            $this->addError('未设置user model');
            return false;
        }
        if($this->validate()){
            $this->user->password_hash = AdminUser::createPassword($this->newPassword);
            return $this->user->save();
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'passwordRepeat' => '重复密码',
            'password' => '密码',
            'newPassword' => '新密码',
        ];
    }
}