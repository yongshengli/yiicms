<?php

use yii\helpers\Html;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/** @var  int $type */

$this->title = '修改分类: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Category::getTypes()[$type].'分类管理', 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="category-update">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('分类列表', ['index','type'=>$model->type]) ?></li>
            <li role="presentation"><?= Html::a('添加分类', ['create', 'type'=>$model->type]) ?></li>
            <li role="presentation" class="active"><?= Html::a('修改分类', ['#']) ?></li>
        </ul>
        <div class="tab-content">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>