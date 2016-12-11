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

    public function init()
    {
        $this->setAttribute('type', static::TYPE_NEWS);
        parent::init();
    }
    /**
     * @return \yii\db\ActiveQuery | \app\models\ContentDetail
     */
    public function getDetail()
    {
        if($this->isNewRecord){
            return new ContentDetail();
        }else{
            return $this->hasOne(ContentDetail::class, ['content_id'=>'id']);
        }
    }

    /**
     * 获取全部的新闻分类
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getCategorys()
    {
        return Category::find()->where(['type'=>self::TYPE_NEWS])->all();
    }
    /**
     * @inheritdoc
     * @return \yii\db\ActiveQuery the newly created [[ActiveQuery]] instance.
     */
    public static function find()
    {
        return Yii::createObject(NewsQuery::className(), [get_called_class()]);
    }
}


class NewsQuery extends ActiveQuery
{
    public function init()
    {
        $this->andWhere(['type'=>Content::TYPE_NEWS]);
        return $this;
    }
    /**
     * Sets the WHERE part of the query.
     *
     * The method requires a `$condition` parameter, and optionally a `$params` parameter
     * specifying the values to be bound to the query.
     *
     * The `$condition` parameter should be either a string (e.g. `'id=1'`) or an array.
     *
     * @inheritdoc
     *
     * @param string|array|Expression $condition the conditions that should be put in the WHERE part.
     * @param array $params the parameters (name => value) to be bound to the query.
     * @return $this the query object itself
     * @see andWhere()
     * @see orWhere()
     * @see QueryInterface::where()
     */
    public function where($condition, $params = [])
    {
        parent::andWhere($condition, $params);
        return $this;
    }
}