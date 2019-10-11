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
$this->params['breadcrumbs'][] = ['label'=>'下载', 'url'=>['/downloads/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-9">
                <div class="panel panel-default panel-<?=\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')?>">
                    <div class="panel-heading"><h3 class="panel-title"><?=$model->title?></h3></div>
                </div>
                <div class="panel-body">
                    <?=Html::encode($model->detail->detail)?>

                    <a href="<?=$model->detail->file_url?>" class="btn btn-primary">下载</a>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <?=$this->render('@app/views/news/_share')?>
                        </div>
                        <div class="col-lg-9 text-right">
                            <?php if($previous = $model->previous()):?>
                                上一条 <?=Html::a($previous->title, ['/downloads/item', 'id'=>$previous->id])?>
                            <?php endif;?>
                            <?php if($next = $model->next()):?>
                                下一条 <?=Html::a($next->title, ['/downloads/item', 'id'=>$next->id])?>
                            <?php endif;?>
                        </div>
                    </div>
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
                <?=\app\widgets\ConfigPanel::widget(['configName'=>'gongyishipin',
                    'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
                ])?>
            </div>
        </div>
    </div>
</div>
<?php $this->renderDynamic('\app\models\Content::hitCounters('.$model->id.');')?>