<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ad */

$this->title = '添加友情链接';
$this->params['breadcrumbs'][] = ['label' => '友情链接管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-create">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('友情链接管理', ['index']) ?></li>
            <li role="presentation" class="active"><?= Html::a('添加友情链接', ['create']) ?></li>
        </ul>
        <div class="tab-content">

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
