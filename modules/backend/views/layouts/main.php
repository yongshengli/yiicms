<?php

/* @var $this \yii\web\View */
/* @var $content string */

use dmstr\web\AdminLteAsset;
use yii\helpers\Html;
use yii\bootstrap\Alert;

if (class_exists('app\modules\backend\assets\BackendAsset')) {
    app\modules\backend\assets\BackendAsset::register($this);
} else {
//    app\assets\AppAsset::register($this);
    dmstr\web\AdminLteAsset::register($this);
}

$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
?>
<?php if (Yii::$app->controller->action->id === 'login'): ?>
    <?= $this->render('main-login', [
        'content' => $content
    ]) ?>
<?php else: ?>
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
    <body class="hold-transition skin-blue sidebar-mini <?= \dmstr\helpers\AdminLteHelper::skinClass() ?> fixed">
    <?php $this->beginBody() ?>

    <div class="wrap" style="height: auto;">
        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>
        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>
    </div>
    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php endif ?>