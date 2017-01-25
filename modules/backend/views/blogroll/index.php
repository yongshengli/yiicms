<?php

use yii\helpers\Html;
use app\modules\backend\widgets\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\AdSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '友情链接管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-index">

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('友情链接管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加友情链接', ['create']) ?></li>
        </ul>
        <div class="tab-content">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php \yii\widgets\Pjax::begin()?>
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
                    [
                        'attribute'=>'image',
                        'format'=>'html',
                        'value'=>function($item){
                            if($item->image){
                                return '<img src="'.$item->image.'" style="height:50px;width:80px"/>';
                            }
                            return '';
                        }
                    ],
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
            <?php \yii\widgets\Pjax::end()?>
        </div>
    </div>
</div>
