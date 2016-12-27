<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('新建分类', ['create', 'type' => $searchModel->type], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'options' => ['style' => 'width:50px']
            ],
            'name',
            [
                'attribute' => 'pid',
                'value' => 'parent.name',
                'options' => ['style' => 'width:100px']
            ],
            [
                'attribute' => 'create_at',
                'format' => 'datetime',
                'options' => ['style' => 'width:150px']
            ],
            // 'update_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => ['style' => 'width:120px'],
                'template' => '{update} {delete}'
            ],
        ],
    ]); ?>
</div>
