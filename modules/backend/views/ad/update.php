<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ad */

$this->title = '修改轮播图: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '轮播图管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="ad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
