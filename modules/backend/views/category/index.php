<?php

use yii\helpers\Html;
use app\modules\backend\widgets\GridView;
use app\models\Category;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/** @var int $type */

$this->title = Category::getTypes()[$type].'分类管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('分类列表', ['index', 'type'=>$type]) ?></li>
            <li role="presentation"><?= Html::a('添加分类', ['create', 'type'=>$type]) ?></li>
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
                    'name',
                    'fullName',
                    [
                        'filterType'=>'date',
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'options' => ['style' => 'width:150px']
                    ],
                    // 'updated_at',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'options' => ['style' => 'width:120px'],
                        'template' => '{update} {delete}'
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
