<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <?php if(!($exception instanceof \yii\web\NotFoundHttpException)):?>
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>
    <?php else:?>
    <p style="text-align: center">
        <iframe scrolling='no' frameborder='0' src='<?=\yii\helpers\Url::to(['site/search-children'])?>' width='100%' height="700px" style='display:block;margin: 20px auto;'></iframe>
    </p>
    <?php endif;?>
</div>