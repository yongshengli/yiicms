<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider*/

$this->title = 'My Yii Application';
use app\widgets\LastNews;
use app\widgets\ConfigPanel;
use yii\widgets\ListView;
use yii\bootstrap\Carousel;
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
            'items' => [
                [
                    'content' => '<img src="http://twitter.github.io/bootstrap/assets/img/bootstrap-mdo-sfmoma-03.jpg"/>',
                    'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
                    'options' => [],
                ],
            ]
        ])?>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PRODUCTS])?>
                <?=\app\widgets\LastNews::widget()?>
                <?=\app\widgets\ConfigPanel::widget(['configName'=>'contact_us'])?>
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
