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
        $oldHash = $this->password_hash;
        if (parent::load($data, $formName)) {
            // 仅当密码字段变化时才重新哈希
            if ($this->password_hash !== $oldHash && !empty($this->password_hash)) {
                $this->resetPassword();
            } elseif (empty($this->password_hash)) {
                $this->password_hash = $oldHash;
            }
            return true;
        }
        return false;
    }

    public function resetPassword()
    {
        $this->password_hash = self::createPassword($this->password_hash);
    }

    /**
     * 验证密码，兼容旧的 MD5 哈希和新 bcrypt 哈希
     */
    public static function validatePassword($postPassword, $storedHash)
    {
        // 先尝试 Yii 安全验证（$2y$ 开头的 bcrypt）
        if (strpos($storedHash, '$2y$') === 0) {
            return Yii::$app->security->validatePassword($postPassword, $storedHash);
        }
        // 兼容旧的 MD5 密码，验证通过后自动升级
        if (md5($postPassword) === $storedHash) {
            return true;
        }
        return false;
    }

    /**
     * 使用 Yii2 安全组件生成 bcrypt 哈希
     */
    public static function createPassword($password)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * 检查密码是否为旧式 MD5，若是则升级
     */
    public function upgradePasswordIfNeeded()
    {
        if (strpos($this->password_hash, '$2y$') !== 0) {
            // MD5 旧密码，下次保存时自动升级
            return true;
        }
        return false;
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
            [['username', 'email'], 'required'],
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
