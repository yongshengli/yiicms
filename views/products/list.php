<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/7
 * Time: 10:55
 * Email:739800600@qq.com
 */

/* @var $this yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */

use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;
use yii\bootstrap\Html;

$this->title = \Yii::t('app','产品');
$this->params['breadcrumbs'][] = HtmlPurifier::process($this->title);
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">

            <div class="col-lg-9">
                <div class="panel panel-default panel-<?=\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')?>">
                    <div class="panel-heading"><h3 class="panel-title"><?=\Yii::t('app','产品中心')?></h3></div>
                </div>
                <div>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "<div class='panel-body'>{items}</div>\n<div class='panel-body'>{pager}</div>",
                        'itemView'=>'_item'
                    ]); ?>
                </div>
            </div>
            <div class="col-lg-3">
                <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PRODUCTS,
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
                <?=\app\widgets\ConfigPanel::widget(['configName'=>'gongyishipin',
                    'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
                ])?>
            </div>
        </div>
    </div>
</div>