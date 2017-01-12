<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ad */

$this->title = '修改友情链接: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '友情链接管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="ad-update">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('友情链接管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加友情链接', ['create']) ?></li>
            <li role="presentation" class="active"><?= Html::a('修改友情链接', ['#']) ?></li>
        </ul>
        <div class="tab-content">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
