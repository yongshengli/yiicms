<?php

use yii\helpers\Html;
use yii\widgets\Menu;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = '新建配置项';
$this->params['breadcrumbs'][] = ['label' => '配置管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-create">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('基础配置', ['base-config']) ?></li>
            <li role="presentation"><?= Html::a('模板配置', ['view-config']) ?></li>
            <li role="presentation"><?= Html::a('其他配置', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('添加配置', ['create']) ?></li>
        </ul>
        <div class="tab-content">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>