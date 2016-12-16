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
    <div class="row">
        <div class="col-lg-10">
            <h1><?= Html::encode($this->title) ?></h1>
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
                    'create_at:datetime',
                    'update_at:datetime',
                ],
            ]) ?>
        </div>
        <div class="col-lg-2">
            <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
                <?= Menu::widget([
//                'template' => "\n<div>\n{items}\n</div>\n",
                    'options' => ['class' => 'nav bs-docs-sidenav'],
                    'submenuTemplate' => "\n<ul class='nav'>\n{items}\n</ul>\n",
                    'items' => [
                        ['label' => '基础配置', 'url' => ['/backend/config/base-config']],
                        ['label' => '其他配置', 'url' => ['/backend/config/index'],'active'=>true]
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>
