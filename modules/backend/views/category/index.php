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
    <div class="row">
        <div class="col-lg-10">
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
        <div class="col-lg-2">
            <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
                <?= yii\widgets\Menu::widget([
//                'template' => "\n<div>\n{items}\n</div>\n",
                    'options' => ['class' => 'nav bs-docs-sidenav'],
                    'submenuTemplate' => "\n<ul class='nav'>\n{items}\n</ul>\n",
                    'items' => [
                        ['label' => '新闻管理', 'url' => ['/backend/news/index'],
                            'items' => [
                                ['label' => '添加新闻', 'url' => ['/backend/news/create']]
                            ]
                        ],
                        ['label' => '分类管理', 'url' => ['/backend/category/index', 'type' => app\models\Content::TYPE_NEWS],
                            'items' => [
                                ['label' => '新建分类', 'url' => ['/backend/category/create','type' => app\models\Content::TYPE_NEWS]]
                            ]
                        ],
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>
