<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/9
 * Time: 10:17
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\Expression;
use Yii;

class News extends Content
{
    const CURRENT_TYPE = Parent::TYPE_NEWS;
}