<?php

/* @var $this \yii\web\View */
/* @var $model \app\models\Config*/
use yii\helpers\Html;
use app\widgets\LastNews;
use app\widgets\ConfigPanel;

$this->title = $model->label;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row">
        <div class="col-lg-3">
            <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PRODUCTS,
                'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')]
            ])?>
            <?=\app\widgets\LastNews::widget(['options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')]
            ])?>
            <?=\app\widgets\ConfigPanel::widget(['configName'=>'contact_us',
                'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')]
            ])?>
        </div>
        <div class="col-lg-9">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="">
                <?=$model->value?>
            </div>
        </div>
    </div>
</div>
