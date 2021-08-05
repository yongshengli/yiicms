<?php
namespace app\components;

use yii\web\UrlManager as BaseUrlManager;
use yii;

class UrlManager extends BaseUrlManager{
    public function createUrl($params){
        return sprintf('/%s%s', yii::$app->language, parent::createUrl($params));
    }
}