<?php

namespace app\models;

use app\components\AppActiveRecord;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $title
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property integer $carete_at
 * @property integer $update_at
 */
class Feedback extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }
}
