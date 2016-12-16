<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider*/
/* @var $adList array*/
$this->title = '首页';
use app\widgets\LastNews;
use app\widgets\ConfigPanel;
use yii\widgets\ListView;
use yii\bootstrap\Carousel;
$carouselItems = [];
foreach($adList as $item){
    $carouselItems[]=[
        'content'=>'<img src="'.$item['image'].'" style="width:100%;max-height:300px"/>',
//        'caption'=>'<h4>'.$item['title'].'</h4>',
    ];
}
?>
<style>
    .image-box{
        height: 210px;width:100%; text-align: center;vertical-align: middle;
    }
    .image{max-width:100%;max-height:200px;vertical-align:middle}
</style>
<div class="site-index">
    <div class="body-content" style="margin-bottom: 20px">
        <?= Carousel::widget([
            'options'=>['class'=>'carousel slide'],
            'items' => $carouselItems
        ])?>
    </div>
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
                    <div class="panel-heading">产品</div>
                </div>
                <div>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{items}\n{pager}",
                        'itemView'=>'@app/views/products/_item'
                    ]); ?>
                </div>
            </div>
        </div>

    </div>
</div>
