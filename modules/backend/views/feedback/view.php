<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => '用户反馈', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'options'=>['class'=>'table table-striped'],
        'attributes' => [
            [
                'attribute'=>'subject',
                'captionOptions'=>['style'=>'width:100px'],
            ],
            'name',
            'email',
            'phone',
            'body',
            'created_at:datetime',
        ],
    ]) ?>

</div>
