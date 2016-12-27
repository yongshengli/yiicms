<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Menu;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '配置列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('添加配置', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'label',
            'value',
            [
                'attribute' => 'create_at',
                'format' => 'datetime',
                'options' => ['style' => 'width:150px'],
            ],
            [
                'attribute' => 'update_at',
                'format' => 'datetime',
                'options' => ['style' => 'width:150px'],
            ],
            ['class' => 'yii\grid\ActionColumn', 'options' => ['style' => 'width:100px']],
        ],
    ]); ?>
</div>
