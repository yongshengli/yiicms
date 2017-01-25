<?php

use yii\helpers\Html;
use app\modules\backend\widgets\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '页面管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('页面管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加页面', ['create']) ?></li>
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
                    'description',
//            'keyword',
                    [
                        'attribute'=>'template',
                        'filter'=>$searchModel->templates
                    ],
                    // 'content',
                    [
                        'filterType'=>'date',
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'options' => ['style' => 'width:160px']
                    ],
                    // 'updated_at',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>

    </div>
</div>
