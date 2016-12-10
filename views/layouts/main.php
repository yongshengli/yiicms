<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="topbar">
        <div class="container">
            你好!
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3"><img src="https://ss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/img/logo_top_ca79a146.png" style="max-width:200px;max-height: 80px"/></div>
            <div class="col-lg-3"></div>
            <div class="col-lg-2"></div>
            <div class="col-lg-4">
                <div class="input-group input-group-lg">
                    <input type="text" class="form-control" placeholder="输入关键字搜索" name="keyword">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">搜索</button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php
    NavBar::begin([
        'brandLabel' => '首页',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-blue bs-docs-nav',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => '产品', 'url' => ['/site/products']],
            ['label' => '新闻', 'url' => ['/news/list']],
            ['label' => '关于我们', 'url' => ['/site/about']],
            ['label' => '联系我们', 'url' => ['/site/contact']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
