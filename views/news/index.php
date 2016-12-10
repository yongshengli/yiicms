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
                <div class="panel panel-default">
                    <div class="panel-heading">Latest news</div>
                    <ul class="list-group">
                        <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Dapibus ac facilisis in</li>
                        <li class="list-group-item">Morbi leo risus</li>
                        <li class="list-group-item">Porta ac consectetur ac</li>
                        <li class="list-group-item">Vestibulum at eros</li>
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">联系我们</div>
                    <div class="panel-body">
                        <p>ADD: Guangdong Province, China TianHe District, GuangZhou Num 899</p>
                        <p>TEL: 020-87961814</p>
                        <p>FAX: 020-98-87961814</p>
                        <p>E-mail: Lankecms@163.com</p>
                    </div>
                </div>
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