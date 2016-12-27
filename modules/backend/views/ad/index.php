<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\AdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '轮播图管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加图片', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'options'=>['style'=>'width:50px']
            ],
            'title',
            'image',
            'link',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'options' => ['style' => 'width:160px']
            ],
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn','template' => '{update} {delete}',
                'options'=>['style'=>'width:60px']
            ],
        ],
    ]); ?>
</div>
