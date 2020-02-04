<?php

namespace app\models;

use app\components\AppActiveRecord;
use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $subject
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $body
 * @property integer $created_at
 * @property integer $updated_at
 */
class Feedback extends AppActiveRecord
{
    /**
     * @var string 验证码
     */
    public $verifyCode;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            [['subject'], 'string', 'max' => 125],
            [['name'], 'string', 'max' => 100],
            ['email', 'email'],
            [['phone', 'email'], 'string', 'max' => 50],
            [['body'], 'string', 'max' => 255],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject' => '主题',
            'name' => '名字',
            'phone' => '电话',
            'email' => 'Email',
            'body' => '内容',
            'created_at' => '创建时间',
            'verifyCode' => '验证码',
        ];
    }
    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function sendEmail($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();
            return true;
        }
        return false;
    }
}
