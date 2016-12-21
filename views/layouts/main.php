<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\widgets\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Carousel;

AppAsset::register($this);
if (isset($this->params['adList'])) {
    foreach ($this->params['adList'] as $item) {
        $carouselItems[] = [
            'content' => '<a href="' . $item['link'] . '" target="_black"><img src="' . $item['image'] . '" style="width:100%;max-height:360px"/></a>',
//        'caption'=>'<h4>'.$item['title'].'</h4>',
        ];
    }
}else{
    $carouselItems = [];
}
$brandLabel = Yii::$app->name;
if(isset(Yii::$app->params['logo'])){
    $brandLabel = '<img src="'.Yii::getAlias(Yii::$app->params['logo']).'" width="120" height="45"/>';
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) . '-' . Yii::$app->name ?></title>
    <?php $this->head() ?>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?baf532329283c0cae060310499633101";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</head>
<body  class="skin-blue fixed">
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="main-header">
        <?php NavBar::begin([
            'brandLabel' => $brandLabel,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-inverse navbar-static-top navbar-'. ArrayHelper::getValue(Yii::$app->params, 'themeColor', 'blue'),
            ],
        ]);
        echo Nav::widget(json_decode(Yii::$app->params['nav'], true));
        ?>
        <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['site/search'], 'options' => ['class' => 'navbar-form navbar-right', 'role' => "search"]]); ?>
        <input type="text" class="form-control input-lg" id="navbar-search-input"
               value="<?= isset($this->params['keyword']) ? $this->params['keyword'] : '' ?>"
               placeholder="输入关键字搜索"
               name="keyword"
        />
        <?php ActiveForm::end(); ?>
        <?php NavBar::end(); ?>
    </div>
    <div class="container">
        <?= Carousel::widget([
            'options'=>['class'=>'carousel slide'],
            'items' => $carouselItems
        ])?>
    </div>
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

        <p class="pull-right">技术支持<a href="http://yiicms.co">YiiCms</a></p>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
