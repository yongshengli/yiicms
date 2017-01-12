<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/12
 * Time: 13:27
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;

use Yii;
/**
 * 友情链接模型
 * Class Blogroll
 * @package app\models
 */
class Blogroll extends Ad
{
    static $currentType = Parent::TYPE_BLOGROLL;

    /**
     * @param bool $runValidation
     * @return bool
     */
    public function beforeSave($runValidation = true)
    {
        if ($runValidation && !$this->validate()) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }
        $file = $this->uploadFile();
        if(!empty($file)) {
            $this->image = $file;
        }
        return true;
    }
}