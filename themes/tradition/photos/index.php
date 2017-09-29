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
use yii\widgets\ListView;
$this->title = $model->title;
$this->params['breadcrumbs']=[];
\app\helpers\CommonHelper::categoryBreadcrumbs($model->category, $this->params['breadcrumbs']);
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
                <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PHOTOS,'title'=>'相册分类',
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
                    <div class="panel-body text-center">
                        <?= ListView::widget([
                            'dataProvider' => $dataProvider,
                            'layout' => "<div class='panel-body'>{items}</div>\n<div class='panel-body'>{pager}</div>",
                            'itemView' => function ($item) {
                                $html = '<p><img src="' . $item->file_url . '"/></p>';
                                $html .= '<p class="text-left">' . $item->detail . '</p>';
                                return $html;
                            }
                        ]); ?>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <?= $this->render('@app/views/news/_share') ?>
                            </div>
                            <div class="col-lg-9 text-right">
                                <?php if ($previous = $model->previous()): ?>
                                    上一相册 <?= Html::a($previous->title, ['/photos/item', 'id' => $previous->id]) ?>
                                <?php endif; ?>
                                <?php if ($next = $model->next()): ?>
                                    下一相册 <?= Html::a($next->title, ['/photos/item', 'id' => $next->id]) ?>
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