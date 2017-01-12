<?php

use yii\helpers\Html;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/** @var int $type */

$this->title = '新建分类';
$this->params['breadcrumbs'][] = ['label' =>  Category::getTypes()[$type].'分类管理', 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('分类列表', ['index','type'=>$model->type]) ?></li>
            <li role="presentation" class="active"><?= Html::a('添加分类', ['create', 'type'=>$model->type]) ?></li>
        </ul>
        <div class="tab-content">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
</div>
