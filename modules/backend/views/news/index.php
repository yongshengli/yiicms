<?php

use yii\helpers\Html;
use app\modules\backend\widgets\GridView;
use yii\grid\CheckboxColumn;
use app\modules\backend\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $pagination yii\data\Pagination */

$this->title = '新闻管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('新闻管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加新闻', ['create']) ?></li>
        </ul>
        <div class="tab-content">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => CheckboxColumn::className()],
                    [
                        'attribute' => 'id',
                        'options' => ['style' => 'width:50px']
                    ],
                    'title',
//            'image',
                    'description',
                    [
                        'attribute' => 'status',
                        'filter'=>$searchModel::$statusList,
                        'options' => ['style' => 'width:60px'],
                        'format' => 'html',
                        'value' => function ($item) {
                            if($item['status']==\app\models\News::STATUS_ENABLE) {
                                return '<span class="badge bg-green">' . $item['statusText'] . '</span>';
                            }else{
                                return '<span class="badge">' . $item['statusText'] . '</span>';
                            }
                        }
                    ],
                    // 'admin_user_id',
                    [
                        'attribute' =>'hits',
                        'options' => ['style' => 'width:70px']
                    ],
                    [
                        'filterType'=>'date',
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'options' => ['style' => 'width:160px']
                    ],
//             'updated_at:datetime',
                    ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
                ],
            ]); ?>
        </div>
    </div>
</div>
