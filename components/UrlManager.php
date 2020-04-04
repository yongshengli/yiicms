<?php
namespace app\components;

use yii\Web\UrlManager as BaseUrlManager;
use yii;

class UrlManager extends BaseUrlManager{
    public function createUrl($params){
        return sprintf('/%s%s', yii::$app->language, parent::createUrl($params));
    }
}