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
    <?php
    NavBar::begin([
        'brandLabel' => '后台管理',
        'brandUrl' => ['/backend/'],
        'options' => [
            'class' => 'navbar-inverse bs-docs-nav',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => '产品管理', 'url' => ['/backend/content/index']],
            ['label' => '新闻管理', 'url' => ['/backend/news/index']],
            ['label' => '网站配置', 'url' => ['/backend/config/index']],
            ['label' => '分类管理', 'url' => ['/backend/category/index']],
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label'=>Yii::$app->user->identity->username,
                'items' => [
                    ['label' => '修改密码', 'url' => ['/backend/default/editPassword']],
                    '<li><a>'
                    . Html::beginForm(['/backend/default/logout'], 'post')
                    . Html::submitButton(
                        '退出',
                        ['class' => 'btn-link']
                    )
                    . Html::endForm()
                    .'</a></li>'
                ]
            ],

        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'homeLink'=>[
                'label'=>'首页',
                'url'=>['/backend/default/index']
            ],
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php if(isset($this->params['showMessage'])):foreach($this->params['showMessage'] as $item):?>
        <div class="alert alert-<?=$item['type']?>" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <?=$item['message']?>
        </div>

        <?php endforeach;endif;?>
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
