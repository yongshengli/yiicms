<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $adList array */
$this->title = '首页';
use app\widgets\LastNews;
use app\widgets\ConfigPanel;
use yii\widgets\ListView;
use yii\bootstrap\Carousel;
use yii\helpers\Url;
use app\helpers\StringHelper;

$carouselItems = [];
?>
<style>
    .image-box {
        height: 210px;
        width: 100%;
        text-align: center;
        vertical-align: middle;
    }

    .image {
        max-width: 100%;
        max-height: 200px;
        vertical-align: middle
    }
</style>
<div class="site-index">
    <div class="row">
        <div class="col-lg-3">
            <?= \app\widgets\Category::widget(['type' => \app\models\Content::TYPE_PRODUCTS,
                'options' => ['class' => 'panel panel-default panel-' . \yii\helpers\ArrayHelper::getValue(Yii::$app->params, 'themeColor')]
            ]) ?>
            <?= \app\widgets\LastNews::widget(['options' => ['class' => 'panel panel-default panel-' . \yii\helpers\ArrayHelper::getValue(Yii::$app->params, 'themeColor')]
            ]) ?>
            <?= \app\widgets\ConfigPanel::widget(['configName' => 'contact_us',
                'options' => ['class' => 'panel panel-default panel-' . \yii\helpers\ArrayHelper::getValue(Yii::$app->params, 'themeColor')]
            ]) ?>
        </div>
        <div class="col-lg-9">
            <div class="panel panel-default panel-<?=\yii\helpers\ArrayHelper::getValue(Yii::$app->params,'themeColor')?>">
                <div class="panel-heading"><h3 class="panel-title">产品展示</h3></div>
            </div>
            <div class="row">
                <?php if (!empty($products)):foreach ($products as $model): ?>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <div class="image-box">
                                <a href="<?= Url::to(['/products/', 'id' => $model->id]) ?>">
                                    <img alt="<?= $model->title ?>" src="<?= $model->image ?>" class="image">
                                </a>
                            </div>
                            <div class="caption">
                                <h5>
                                    <a href="<?= Url::to(['/products/', 'id' => $model->id]) ?>"
                                       title="<?= $model->title ?>">
                                        <?= StringHelper::truncateUtf8String($model->title, 13, false) ?>
                                    </a>
                                </h5>
                                <div style="height: 40px;overflow: hidden;">
                                    <?= $model->description ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;endif; ?>
            </div>
        </div>
    </div>
</div>
