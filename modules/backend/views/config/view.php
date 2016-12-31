<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Menu;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '网站配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-view">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('基础配置', ['base-config']) ?></li>
            <li role="presentation"><?= Html::a('模板配置', ['view-config']) ?></li>
            <li role="presentation"><?= Html::a('其他配置', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加配置', ['create']) ?></li>
            <li role="presentation" class="active"><?= Html::a('配置详情', ['#']) ?></li>
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
                        'attribute' => 'name',
                        'captionOptions' => ['style' => 'width:100px'],
                    ],
                    'label',
                    'value',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>
