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

AppAsset::register($this)->css = [Yii::getAlias('/themes/tradition/css/site.css'),];
$carouselItems = [];
if (isset($this->params['adList'])) {
    foreach ($this->params['adList'] as $item) {
        $carouselItems[] = [
            'options'=>['style'=>'"background:url('.$item['image'].');background-size:cover;'],
            'content' => '<a href="' . $item['link'] . '" target="_black"><img src="' . $item['image'] . '" style="width:100%"/></a>',
//        'caption'=>'<h4>'.$item['title'].'</h4>',
        ];
    }
}
$brandLabel = Yii::$app->name;
if(!empty(Yii::$app->params['logo'])){
    $brandLabel = '<img src="'.Yii::getAlias(Yii::$app->params['logo']).'"/>';
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
        (function(){
            var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?44fe98c387976b344e710998b9ca68bb":"https://jspassport.ssl.qhimg.com/11.0.1.js?44fe98c387976b344e710998b9ca68bb";
            document.write('<script src="' + src + '" id="sozz"><\/script>');
        })();
    </script>
</head>
<body  class="skin-blue fixed">
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="topbar">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <?=Yii::t('app', \app\widgets\Hook::widget(['configName'=>'top_message']))?>
                    <span class="label label-warning">
                        <a href="<?=Url::to(['/site/language','language'=>'en-US'])?>">English</a>/<a href="<?=Url::to(['/site/language','language'=>'zh-CN'])?>">中文</a>
                    </span>
                </div>
                <div class="col-lg-3">
                    <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['site/search'], 'options' => ['class' => 'navbar-form navbar-right', 'role' => "search"]]); ?>
                    <div class="input-group input-group-sm" style="margin-top: -16px">
                        <input type="text" class="form-control" id="navbar-search-input"
                               value="<?= isset($this->params['keyword']) ? $this->params['keyword'] : '' ?>"
                               placeholder="<?=Yii::t('app','输入关键字搜索')?>"
                               name="keyword"
                        />
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><?=Yii::t('app','搜索')?></button>
                        </span>
                    </div><!-- /input-group -->
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <div>
        <?php NavBar::begin([
            'brandLabel' => $brandLabel,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar  navbar-'. ArrayHelper::getValue($this->params, 'themeColor', 'blue'),
            ],
        ]);
        echo Nav::widget(\app\helpers\CommonHelper::navTranslation(json_decode(Yii::$app->params['nav'], true)));
        ?>
        <?php NavBar::end(); ?>
    </div>
    <div style="margin-bottom: 20px">
        <?= Carousel::widget([
            'options'=>['class'=>'carousel slide', 'data-ride'=>"carousel"],
            'items' => $carouselItems,
            'controls'=>['<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>',
            '<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>'],
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
        <div class="row">
            <div class="col-lg-12">&copy; YiiCms <?= date('Y') ?> 版权所有 侵权必究</div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <ul>
                    <li><a href="<?=Url::to(['/backend'])?>" target="_blank">后台演示</a></li>
                    <li><a href="http://git.oschina.net/templi/yiicms" target="_blank">源码下载</a></li>
                    <li><a href="https://github.com/yongshengli/yiicms" target="_blank">github下载</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                友情链接
                <?=\app\widgets\Blogroll::widget()?>
            </div>
            <div class="col-lg-3">
                QQ群:248898849
            </div>
            <div class="col-lg-3">
                <p>技术支持<a href="http://yiicms.co">YiiCms</a> <?= \app\widgets\Hook::widget(['configName'=>'tongji']); ?></p>
            </div>
        </div>
    </div>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
