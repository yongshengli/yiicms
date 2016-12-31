<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\backend\models\AdminUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-index">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('管理员管理', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加管理员', ['create']) ?></li>
        </ul>
        <div class="tab-content">
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'attribute' => 'id',
                        'options' => ['style' => 'width:50px']
                    ],
                    'username',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'options' => ['style' => 'width:50px']
                    ],
                    // 'access_token',
                    [
                        'attribute' => 'created_at',
                        'format' => 'datetime',
                        'options' => ['style' => 'width:150px']
                    ],
                    [
                        'attribute' => 'updated_at',
                        'format' => 'datetime',
                        'options' => ['style' => 'width:150px']
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'options' => ['style' => 'width:100px']
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
