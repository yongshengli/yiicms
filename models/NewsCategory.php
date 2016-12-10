<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/10
 * Time: 19:10
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;


class NewsCategory extends Category
{
    /**
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function insert($runValidation = true, $attributeNames = null)
    {
        $this->type = Content::TYPE_NEWS;
        return parent::insert($runValidation, $attributeNames);
    }
}