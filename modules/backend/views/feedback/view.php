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

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('用户反馈', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('详情', ['#']) ?></li>
        </ul>
        <div class="tab-content">

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
                'options' => ['class' => 'table table-striped'],
                'attributes' => [
                    [
                        'attribute' => 'subject',
                        'captionOptions' => ['style' => 'width:100px'],
                    ],
                    'name',
                    'email',
                    'phone',
                    'body',
                    'created_at:datetime',
                ],
            ]) ?>

        </div>
    </div>
</div>
