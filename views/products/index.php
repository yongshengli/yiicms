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
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-3">
                <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PRODUCTS])?>
                <?=\app\widgets\LastNews::widget()?>
                <?=\app\widgets\ConfigPanel::widget(['configName'=>'contact_us'])?>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="<?=$model->image?>" alt="<?=$model->title?>" class="img-thumbnail" style="height: 280px">
                    </div>
                    <div class="col-lg-6">
                        <div><?=$model->title?></div>
                    </div>
                </div>

                <div class="panel panel-default" style="margin-top: 20px">
                    <div class="panel-heading">产品详情</div>
                </div>
                <div>
                    <?=$model->detail->detail?>
                </div>
            </div>

        </div>
    </div>
</div>