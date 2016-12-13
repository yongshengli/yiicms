<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ad */

$this->title = '添加图片';
$this->params['breadcrumbs'][] = ['label' => '轮播图', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
