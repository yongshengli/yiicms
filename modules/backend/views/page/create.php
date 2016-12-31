<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = '添加页面';
$this->params['breadcrumbs'][] = ['label' => '页面管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" ><?= Html::a('页面管理', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('添加页面', ['create']) ?></li>
        </ul>
        <div class="tab-content">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
