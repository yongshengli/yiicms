<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/9
 * Time: 10:17
 * Email:739800600@qq.com
 */

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\Expression;
use Yii;

class News extends Content
{
    static $currentType = parent::TYPE_NEWS;
}