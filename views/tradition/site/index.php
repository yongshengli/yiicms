<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $adList array */
use yii\helpers\Url;
use app\helpers\StringHelper;
use yii\helpers\ArrayHelper;

$this->title = ArrayHelper::getValue(Yii::$app->params,'homeTitle', 'YiiCms首页');
$carouselItems = [];
?>
<style>
    .image-box a{
        height: 240px;width:240px; text-align: center;vertical-align: middle;display: table-cell;
    }
    .image{max-width:100%;max-height:200px;vertical-align:middle;display: inline}
</style>
<div class="site-index panel">
    <div class="projects-header page-header">
        <h2>关于YiiCms <small>About the YiiCms</small></h2>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-4">
                <h3 class="text-center">快速/安全/专业</h3>
                <p>YiiCms 基于Yii2 框架开发。
                    Yii只加载您需要的功能。它具有强大的缓存支持。
                    它的标准是安全的。它包括了输入验证，输出过滤，SQL 注入和跨站点脚本的预防。
                    它遵循了 MVC 模式，确保了清晰分离逻辑层和表示层。
                </p>
            </div>
            <div class="col-sm-4">
                <h3 class="text-center">开源/免费/强大</h3>
                <p>YiiCms 是免费开源的企业站系统，功能强大齐全。<br/>
                    主要功能：文章管理，产品管理，下载管理，相册管理，多模板支持，前台菜单自定义，后台菜单自定义等等。
                </p>
            </div>
            <div class="col-sm-4">
                <h3 class="text-center">一个框架、多种设备</h3>
                <p>前台样式使用Bootstrap 框架开发，兼容各种设备。<br>
                    你的网站和应用能在 Bootstrap 的帮助下通过同一份代码快速、有效适配手机、平板、PC 设备，这一切都是 CSS 媒体查询（Media Query）的功劳。
                </p>
            </div>
        </div>
    </div>
</div>
<div class="site-index panel">
    <div class="projects-header page-header">
        <h2>产品展示 <small>The latest product</small></h2>

    </div>
    <div class="panel-body">
        <div class="row">
            <?php if (!empty($products)):foreach ($products as $model): ?>
                <div class="col-md-3">
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
<div class="row">
    <div class="col-md-7">
        <div class="panel">
            <div class="projects-header page-header">
                <h2>企业咨询
                    <small>The latest news</small>
                </h2>
            </div>
            <?= \app\widgets\LastNews::widget([
                'showDate' => true,
                'showHeader' => false,
                'limit'=>6,
                'options' => ['class' => 'panel-body'],
                'itemOptions' => ['class' => 'list-group-item-simple']
            ]) ?>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel">
            <div class="projects-header page-header">
                <h2>联系我们
                    <small>connect us</small>
                </h2>
            </div>
            <?=\app\widgets\ConfigPanel::widget([
                'configName'=>'contact_us',
                'showHeader'=>false,
                'options' => ['class' => 'panel-body'],
            ])?>
        </div>
    </div>
</div>