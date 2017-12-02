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
use yii\widgets\ListView;
use yii\bootstrap\Html;

$this->title = '产品';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .caption{text-align: left}
    @media screen and (min-width:1200px) {
        .thumbnail{width:240px;text-align: center;margin-left: auto; margin-right: auto;padding: 0}
        .image-box{border-bottom: 1px solid #ddd;padding: 5px}
        .image-box a{
            height: 230px;width:230px; text-align: center;vertical-align: middle;display: table-cell;
        }
        .image{max-width:100%;max-height:230px;vertical-align:middle;display: inline}
    }
    @media ( min-width:992px ) and ( max-width:1199px ) {
        .thumbnail{width:200px;text-align: center;margin-left: auto; margin-right: auto;padding: 0}
        .image-box{border-bottom: 1px solid #ddd;padding: 5px}
        .image-box a{
            height: 200px;width:200px; text-align: center;vertical-align: middle;display: table-cell;
        }
        .image{max-width:100%;max-height:190px;vertical-align:middle;display: inline}
        h5, .h5 {font-size: 12px}
        .caption{font-size: 12px;}
    }
</style>
<div class="site-index">
    <div class="body-content">
        <div class="row">

            <div class="col-lg-9">
                <div class="panel panel-default panel-<?=\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')?>">
                    <div class="panel-heading" style="border-bottom: none;"><h3 class="panel-title">产品中心</h3></div>
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