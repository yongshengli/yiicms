<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/8
 * Time: 16:39
 * Email:liyongsheng@meicai.cn
 */

namespace app\components;
use \yii\db\ActiveRecord;

class AppActiveRecord extends ActiveRecord
{
    /**
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function insert($runValidation = true, $attributeNames = null)
    {
        $this->create_at = $this->update_at = time();
        return parent::insert($runValidation, $attributeNames);
    }
    /**
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function update($runValidation = true, $attributeNames = null)
    {
        $this->update_at = time();
        return parent::update($runValidation, $attributeNames);
    }
}