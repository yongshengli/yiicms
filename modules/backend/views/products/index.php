<?php

use yii\helpers\Html;
use app\modules\backend\widgets\GridView;
use app\models\Products;
use yii\grid\CheckboxColumn;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $pagination yii\data\Pagination */

$this->title = '产品管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-index">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('产品管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加产品', ['create']) ?></li>
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
                        'options' => ['style' => 'width:60px'],
                        'format' => 'html',
                        'filter'=>$searchModel::$statusList,
                        'value' => function ($item) {
                            if($item['status']==Products::STATUS_ENABLE) {
                                return '<span class="badge bg-green">' . $item['statusText'] . '</span>';
                            }else{
                                return '<span class="badge">' . $item['statusText'] . '</span>';
                            }
                        }
                    ],
                    // 'admin_user_id',
                    [
                        'attribute' =>'hits',
                        'options' => ['style' => 'width:50px']
                    ],
                    [
                        'attribute' => 'created_at',
                        'filterType'=>'date',
                        'format' => 'datetime',
                        'options' => ['style' => 'width:160px']
                    ],
//             'updated_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',
                        'options' => ['style' => 'width:60px']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>