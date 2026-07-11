<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $adList array */
use app\widgets\LastNews;
use app\widgets\ConfigPanel;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;
use yii\bootstrap\Carousel;
use yii\helpers\Url;
use app\helpers\StringHelper;
use yii\helpers\ArrayHelper;

$this->title = ArrayHelper::getValue(Yii::$app->params,'homeTitle', 'YiiCms首页');
$carouselItems = [];
?>
<div class="site-index">
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default panel-<?=\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')?>">
                <div class="panel-heading"><h3 class="panel-title"><?=\Yii::t('app','产品展示')?></h3></div>
            </div>
            <div class="row">
                <?php if (!empty($products)):foreach ($products as $model): ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail product-card">
                            <div class="image-box">
                                <a href="<?= Url::to(['/products/item', 'id' => $model->id]) ?>">
                                    <img alt="<?= HtmlPurifier::process($model->title) ?>" src="<?=$model->image ?>" class="image">
                                </a>
                            </div>
                            <div class="caption">
                                <h5>
                                    <a href="<?= Url::to(['/products/item', 'id' => $model->id]) ?>"
                                       title="<?= HtmlPurifier::process($model->title) ?>">
                                        <?= StringHelper::truncateUtf8String($model->title, 13, false) ?>
                                    </a>
                                </h5>
                                <p class="text-muted"><?= HtmlPurifier::process($model->description) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach;endif; ?>
            </div>
        </div>
        <div class="col-lg-3">
            <?= \app\widgets\Category::widget(['type' => \app\models\Content::TYPE_PRODUCTS,
                'options' => ['class' => 'panel panel-default panel-' . \yii\helpers\ArrayHelper::getValue($this->params, 'themeColor')]
            ]) ?>
            <?= \app\widgets\LastNews::widget(['options' => ['class' => 'panel panel-default panel-' . \yii\helpers\ArrayHelper::getValue($this->params, 'themeColor')]
            ]) ?>
            <?= \app\widgets\ConfigPanel::widget(['configName' => 'contact_us',
                'options' => ['class' => 'panel panel-default panel-' . \yii\helpers\ArrayHelper::getValue($this->params, 'themeColor')]
            ]) ?>
            <?=\app\widgets\ConfigPanel::widget(['configName'=>'donate',
                'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
            ])?>
        </div>
    </div>
</div>
