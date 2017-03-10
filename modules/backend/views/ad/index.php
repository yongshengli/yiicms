<?php

use yii\helpers\Html;
use app\modules\backend\widgets\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\AdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '轮播图管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adx-index">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('轮播图管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加轮播图', ['create']) ?></li>
        </ul>
        <div class="tab-content">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'layout'=>"{summary}\n{items}\n{pager}",
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'id',
                        'options' => ['style' => 'width:50px']
                    ],
                    'title',
                    'image',
                    'link',
                    [
                        'filterType'=>'date',
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'options' => ['style' => 'width:160px']
                    ],
                    // 'updated_at',

                    ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',
                        'options' => ['style' => 'width:60px']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
