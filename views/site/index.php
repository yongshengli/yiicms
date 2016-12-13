<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider*/

$this->title = 'My Yii Application';
use app\widgets\LastNews;
use app\widgets\ConfigPanel;
use yii\widgets\ListView;
?>
<style>
    .image-box{
        height: 210px;width:100%; text-align: center;vertical-align: middle;
    }
    .image{max-width:100%;max-height:200px;vertical-align:middle}
</style>
<div class="site-index">
    <div class="body-content" style="margin-bottom: 20px">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height: 280px">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="..." alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
            <div class="item">
                <img src="..." alt="...">
                <div class="carousel-caption">
                    ...
                </div>
            </div>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
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
