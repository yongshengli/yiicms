<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '配置列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">
    <?php  //echo $this->render('_search', ['model' => $searchModel]); ?>
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
                'format' => 'text',
                'value' => function ($data) {
                    return date("Y-m-d H:i:s", ($data->create_at));
                },
            ],
            [
                'attribute' => 'update_at',
                'format' => 'text',
                'value' => function ($data) {
                    return date("Y-m-d H:i:s", ($data->update_at));
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
