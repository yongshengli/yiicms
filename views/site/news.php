<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/7
 * Time: 10:55
 * Email:liyongsheng@meicai.cn
 */

/* @var $this yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */
use yii\grid\GridView;

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">CATEGORIES</div>
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Latest news</div>
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Contact us</div>
                    <div class="panel-body">
                        <p>ADD: Guangdong Province, China TianHe District, GuangZhou Num 899</p>
                        <p>TEL: 020-87961814</p>
                        <p>FAX: 020-98-87961814</p>
                        <p>E-mail: Lankecms@163.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">新闻</div>
                </div>
                <div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions'=>['class'=>'table-simple'],
                        'showHeader'=>false,
                        'layout' => "{items}\n{pager}",
                        'columns' => [
                            'title',
                            [
                                'attribute'=>'create_at',
                                'format'=>'date',
                                'options'=>['style'=>'width:160px']
                            ],
                        ],
//                        'LinkPager'=>['options'=>['class'=>'pagination pagination-right']]
                    ]); ?>
                </div>
            </div>

        </div>
    </div>
</div>