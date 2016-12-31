<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\backend\models\AdminUser */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => '管理员管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-view">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('管理员管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加管理员', ['create']) ?></li>
            <li role="presentation" class="active"><?= Html::a('详情', ['#']) ?></li>
        </ul>
        <div class="tab-content">
    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
        'attributes' => [
            [
                'attribute'=>'username',
                'captionOptions'=>['style'=>'width:120px']
            ],
            'auth_key',
            'password_reset_token',
            'email:email',
            'status',
            'access_token',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
