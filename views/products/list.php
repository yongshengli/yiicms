<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/7
 * Time: 10:55
 * Email:liyongsheng@meicai.cn
 */

/* @var $this yii\web\View */
/** @var $dataProvider \yii\data\ActiveDataProvider */
use yii\widgets\ListView;
use yii\bootstrap\Html;

$this->title = '产品';
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
                <div class="panel panel-default">
                    <div class="panel-heading">产品</div>
                </div>
                <div>
                    <?= ListView::widget([
                        'dataProvider' => $dataProvider,
                        'layout' => "{items}\n{pager}",
                        'itemView'=>'_item'
                    ]); ?>
                </div>
            </div>

        </div>
    </div>
</div>