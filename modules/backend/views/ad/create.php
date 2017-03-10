<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ad */

$this->title = '添加图片';
$this->params['breadcrumbs'][] = ['label' => '轮播图', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adx-create">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('轮播图管理', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('添加轮播图', ['create']) ?></li>
        </ul>
        <div class="tab-content">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
