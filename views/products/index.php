<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/7
 * Time: 10:55
 * Email:liyongsheng@meicai.cn
 */

/* @var $this yii\web\View */
/* @var $model \app\models\News */
use yii\bootstrap\Html;
use app\widgets\LastNews;
use app\widgets\ConfigPanel;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label'=>'产品', 'url'=>['/products/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .img-box{
        height: 290px;width:100%; text-align: center;vertical-align: middle;
    }
    .img-box img{
        display: inline;
        max-width:100%;max-height: 280px;
    }
</style>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PRODUCTS,
                    'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')]
                ])?>
                <?=\app\widgets\LastNews::widget(['options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')]
                ])?>
                <?=\app\widgets\ConfigPanel::widget(['configName'=>'contact_us',
                    'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')]
                ])?>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="img-thumbnail img-box">
                            <img src="<?=$model->image?>" alt="<?=$model->title?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4><?=$model->title?></h4>
                        <div><?=$model->description?></div>
                    </div>
                </div>

                <div class="panel panel-default panel-<?=\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')?>" style="margin-top: 20px">
                    <div class="panel-heading"><h3 class="panel-title">产品详情</h3></div>
                </div>
                <div class="panel-body">
                    <?=$model->detail->detail?>
                </div>
            </div>

        </div>
    </div>
</div>