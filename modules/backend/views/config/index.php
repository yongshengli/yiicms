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
    <div class="row">
        <div class="col-lg-10">
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
        <div class="col-lg-2">
            <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
                <?= Menu::widget([
//                'template' => "\n<div>\n{items}\n</div>\n",
                    'options' => ['class' => 'nav bs-docs-sidenav'],
                    'submenuTemplate' => "\n<ul class='nav'>\n{items}\n</ul>\n",
                    'items' => [
                        ['label' => '基础配置', 'url' => ['/backend/config/base-config']],
                        ['label' => '其他配置', 'url' => ['/backend/config/index'],
                            'items'=>[
                                ['label'=>'添加配置', 'url'=>['/backend/config/create']]
                            ]
                        ]
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>
