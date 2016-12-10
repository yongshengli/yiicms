<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\widgets\LastNews;
use app\widgets\ConfigPanel;

$this->title = $model->label;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="row">
        <div class="col-lg-4">
            <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PRODUCTS])?>
            <?=\app\widgets\LastNews::widget()?>
            <?=\app\widgets\ConfigPanel::widget(['configName'=>'contact_us'])?>
        </div>
        <div class="col-lg-8">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="">
                <?=$model->value?>
            </div>
        </div>
    </div>
</div>
