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
$this->params['breadcrumbs'][] = ['label'=>Yii::t('app', '产品'), 'url'=>['/products/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .img-box{
        height: 400px;width:400px; text-align: center;vertical-align: middle;display: table-cell;
    }
    .img-box img{
        display: inline;
        max-width:400px;max-height: 400px;
    }
</style>
<div class="site-index">
    <div class="body-content">
        <div class="row">
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
            </div>
            <div class="col-lg-9">
                <div class="panel panel-default">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="img-rounded">
                                <div class="img-box">
                                    <img src="<?= $model->image ?>" alt="<?= $model->title ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="panel-body">
                                <h4><?= $model->title ?></h4>
                                <div><?= $model->detail->params ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default panel-<?= \yii\helpers\ArrayHelper::getValue($this->params, 'themeColor') ?>"
                    style="margin-top: 20px">
                    <div class="panel-heading"><h3 class="panel-title"><?=Yii::t('app', '产品详情')?></h3></div>


                    <div class="panel-body">
                        <?= $model->detail->detail ?>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $this->render('@app/views/news/_share') ?>
                            </div>
                            <div class="col-lg-9 text-right">
                                <?php if ($previous = $model->previous()): ?>
                                    上一条 <?= Html::a($previous->title, ['/products/index', 'id' => $previous->id]) ?>
                                <?php endif; ?>
                                <?php if ($next = $model->next()): ?>
                                    下一条 <?= Html::a($next->title, ['/products/index', 'id' => $next->id]) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $this->renderDynamic('\app\models\Content::hitCounters('.$model->id.');')?>