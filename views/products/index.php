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
    @media (min-width:768px) {
        .img-box {
            height: 400px;
            width: 400px;
            text-align: center;
            vertical-align: middle;
            display: table-cell;
            max-width: 100%
        }
        .img-box img {
            display: inline;
            max-width: 100%;
            max-height: 400px;
        }
    }
    @media (max-width:767px){
        .img-box{
            text-align: center;
        }
        .img-box img{
            display: inline;
            max-height: 400px;
        }
    }
</style>
<div class="site-index">
    <div class="body-content">
        <div class="row">

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="img-thumbnail">
                            <div class="img-box">
                                <img src="<?=$model->image?>" alt="<?=$model->title?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <h4><?=$model->title?></h4>
                        <div>
                            <div>
                                <?=$model->detail->params?>
                            </div>
                            <div style="margin-top: 15px">
                                在线咨询:
                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?= \app\widgets\Hook::widget(['configName'=>'qq_number'])?\app\widgets\Hook::widget(['configName'=>'qq_number']):'739800600';?>&site=qq&menu=yes">
                                    <img border="0" src="http://wpa.qq.com/pa?p=2:739800600:51" alt="点击这里给我发消息" title="点击这里给我发消息"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default panel-<?=\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')?>" style="margin-top: 20px">
                    <div class="panel-heading" style="border-bottom: none;"><h3 class="panel-title">产品详情</h3></div>
                </div>

                <div class="panel-body">
                    <?=Html::encode($model->detail->detail)?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <?=$this->render('@app/views/news/_share')?>
                        </div>
                        <div class="col-lg-9 text-right">
                            <?php if($previous = $model->previous()):?>
                                上一条 <?=Html::a($previous->title, ['/products/item', 'id'=>$previous->id])?>
                            <?php endif;?>
                            <?php if($next = $model->next()):?>
                                下一条 <?=Html::a($next->title, ['/products/item', 'id'=>$next->id])?>
                            <?php endif;?>
                        </div>
                    </div>
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
<?php $this->renderDynamic('\app\models\Content::hitCounters('.$model->id.');')?>