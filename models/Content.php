<?php

namespace app\models;

use app\components\AppActiveRecord;

/**
 * This is the model class for table "content".
 *
 * @property integer $id
 * @property string $title
 * @property integer $type
 * @property string $image
 * @property string $description
 * @property integer $status
 * @property integer $admin_user_id
 * @property integer $create_at
 * @property integer $update_at
 */
class Content extends AppActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'content';
    }
}
