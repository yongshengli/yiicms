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
use yii\bootstrap\Html;

$this->title = '下载';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-9">
                <div class="panel panel-default panel-<?=\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')?>">
                    <div class="panel-heading" style="border-bottom: none;"><h3 class="panel-title">下载</h3></div>
                </div>
                <div>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'tableOptions'=>['class'=>'table-simple'],
                        'showHeader'=>false,
                        'layout' => "{items}\n{pager}",
                        'columns' => [
                            [
                                'attribute'=>'title',
                                'format'=>'raw',
                                'value'=>function($item){
                                    return Html::a($item->title, ['/downloads/item', 'id'=>$item->id]);
                                }
                            ],
                            [
                                'attribute'=>'created_at',
                                'format'=>'date',
                                'options'=>['class'=>'text-right','style'=>'width:100px']
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_DOWNLOADS,'title'=>'下载分类',
                    'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
                ])?>
                <?=\app\widgets\LastNews::widget(['options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
                ])?>
                <?=\app\widgets\ConfigPanel::widget(['configName'=>'contact_us',
                    'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
                ])?>
                <?=\app\widgets\ConfigPanel::widget(['configName'=>'donate',
                    'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
                ])?>
            </div>
        </div>
    </div>
</div>