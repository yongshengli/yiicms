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
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">CATEGORIES</div>
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <?=LastNews::widget()?>
                <?=ConfigPanel::widget(['configName'=>'contact_us'])?>
            </div>
            <div class="col-lg-8">
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