<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\LinkPager;
use yii\widgets\Menu;
use app\models\Content;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $pagination yii\data\Pagination */

$this->title = '新闻管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('添加新闻', ['create'], ['class' => 'btn btn-success']) ?>
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
            'title',
//            'image',
            'description',
            [
                'attribute' => 'status',
                'options' => ['style' => 'width:60px'],
                'format' => 'text',
                'value' => 'statusText'
            ],
            // 'admin_user_id',
            [
                'attribute' => 'created_at',
                'format' => 'datetime',
                'options' => ['style' => 'width:160px']
            ],
//             'update_at:datetime',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
