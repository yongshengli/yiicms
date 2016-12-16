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
$this->params['breadcrumbs'][] = ['label'=>'新闻', 'url'=>['/news/list']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
                <div class="panel panel-default">
                    <div class="panel-heading"><?=$model->title?></div>
                </div>
                <div>
                    <?=$model->detail->detail?>
                </div>
            </div>

        </div>
    </div>
</div>