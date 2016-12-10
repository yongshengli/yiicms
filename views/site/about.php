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
            <div class="panel panel-default">
                <div class="panel-heading">CATEGORIES</div>
                <ul class="list-group">
                    <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
            </div>
            <?=LastNews::widget()?>
            <?=ConfigPanel::widget(['configName'=>'contact_us'])?>
        </div>
        <div class="col-lg-8">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="">
                <?=$model->value?>
            </div>
        </div>
    </div>
</div>
