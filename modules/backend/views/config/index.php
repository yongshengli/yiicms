<?php

use yii\helpers\Html;
use app\modules\backend\widgets\GridView;
use yii\widgets\Menu;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\ConfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '其他配置';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-index">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('基础配置', ['base-config']) ?></li>
            <li role="presentation"><?= Html::a('模板配置', ['view-config']) ?></li>
            <li role="presentation" class="active"><?= Html::a('其他配置', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加配置', ['create']) ?></li>
        </ul>
        <div class="tab-content">
            <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

            <?= GridView::widget([
                'layout'=>"{summary}\n{items}\n{pager}",
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    'label',
                    'value',
                    [
                        'filterType'=>'date',
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'options' => ['style' => 'width:150px'],
                    ],
                    ['class' => 'yii\grid\ActionColumn', 'options' => ['style' => 'width:100px']],
                ],
            ]); ?>
        </div>
    </div>
</div>
