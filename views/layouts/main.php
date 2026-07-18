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
use yii\helpers\Url;

AppAsset::register($this);
$carouselItems = [];
if (isset($this->params['adList'])) {
    foreach ($this->params['adList'] as $item) {
        $carouselItems[] = [
            'content' => '<a href="' . $item['link'] . '" target="_blank"><img src="' . $item['image'] . '" alt="" style="width:100%"/></a>',
        ];
    }
}
$brandLabel = Yii::$app->name;
if(!empty(Yii::$app->params['logo'])){
    $brandLabel = '<img src="'.Yii::getAlias(Yii::$app->params['logo']).'" alt="'.Html::encode(Yii::$app->name).'"/>';
}
$themeColor = ArrayHelper::getValue($this->params, 'themeColor', 'blue');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) . ' - ' . Yii::$app->name ?></title>
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
<body class="skin-blue">
<?php $this->beginBody() ?>

<!-- ========== 顶部导航栏 ========== -->
<div class="main-header">
    <?php NavBar::begin([
        'brandLabel' => $brandLabel,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-static-top navbar-' . $themeColor,
        ],
    ]);
    echo Nav::widget(
        array_merge(
            json_decode(Yii::$app->params['nav'], true),
            ["options" => ["class" => "nav navbar-nav"]]
        ));
    ?>
    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['site/search'], 'options' => ['class' => 'navbar-form navbar-right', 'role' => "search"]]); ?>
    <input type="text" class="form-control" id="navbar-search-input"
           value="<?= isset($this->params['keyword']) ? Html::encode($this->params['keyword']) : '' ?>"
           placeholder="输入关键字搜索"
           name="keyword"
    />
    <?php ActiveForm::end(); ?>
    <?php NavBar::end(); ?>
</div>

<!-- ========== 轮播广告区 ========== -->
<?php if (!empty($carouselItems)): ?>
<div class="container" style="margin-top: 24px">
    <?= Carousel::widget([
        'options' => ['class' => 'carousel slide', 'data-ride' => "carousel", 'data-interval' => '4000'],
        'items' => $carouselItems,
        'controls' => [
            '<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span><span class="sr-only">Previous</span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span><span class="sr-only">Next</span>'
        ],
    ]) ?>
</div>
<?php endif; ?>

<!-- ========== 主体内容区 ========== -->
<div class="wrap">
    <div class="container" style="margin-top: 15px">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<!-- ========== 页脚 ========== -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <h5><?= Html::encode(Yii::$app->name) ?></h5>
                <ul>
                    <li><a href="<?= Url::to(['/backend']) ?>" target="_blank">后台管理</a></li>
                    <li><a href="https://github.com/yongshengli/yiicms" target="_blank">GitHub</a></li>
                    <li><a href="<?= Url::to(['/site/contact']) ?>">联系我们</a></li>
                </ul>
            </div>
            <div class="col-sm-6 col-md-3">
                <h5><?= Yii::t('app', '友情链接') ?></h5>
                <?= \app\widgets\Blogroll::widget() ?>
            </div>
            <div class="col-sm-6 col-md-3">
                <h5>交流社区</h5>
                <p style="color: var(--gray-300);">QQ群：248898849</p>
            </div>
            <div class="col-sm-6 col-md-3">
                <h5>技术支持</h5>
                <p><a href="http://www.guoway.net" target="_blank">天津果唯网络科技有限公司</a></p>
            </div>
        </div>
        <div class="footer-divider">
            <div class="row">
                <div class="col-md-12 copyright">
                    &copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?> 版权所有 侵权必究  <?= \app\widgets\Hook::widget(['configName' => 'beian']); ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<?= \app\widgets\Hook::widget(['configName'=>'kefu']); ?>
<!-- 回到顶部按钮 -->
<button class="back-to-top" id="backToTop" title="回到顶部">
    <span class="glyphicon glyphicon-chevron-up"></span>
</button>

<script>
// 回到顶部按钮
(function() {
    var btn = document.getElementById('backToTop');
    var scrollThreshold = 400;

    function toggle() {
        if (window.pageYOffset > scrollThreshold) {
            btn.classList.add('visible');
        } else {
            btn.classList.remove('visible');
        }
    }

    btn.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    window.addEventListener('scroll', toggle, { passive: true });
    toggle();
})();
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
