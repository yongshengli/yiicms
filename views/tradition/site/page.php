<?php

/* @var $this \yii\web\View */
/* @var $page \app\models\Page*/
use yii\helpers\Html;
use app\widgets\LastNews;
use app\widgets\ConfigPanel;

$this->title =  Yii::t('app', $page->title);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row">
        <div class="col-lg-3">
            <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PRODUCTS,
                'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
            ])?>
            <?=\app\widgets\LastNews::widget(['options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
            ])?>
            <?=\app\widgets\ConfigPanel::widget(['configName'=>'contact_us',
                'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
            ])?>
            <?=\app\widgets\ConfigPanel::widget(['configName'=>'donate',
                'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
            ])?>
        </div>
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-body page-header">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="panel-body">
                    <?= $page->content ?>
                </div>
            </div>
        </div>
    </div>
</div>
