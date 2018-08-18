<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Feedback */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models\Feedback;

$this->title = '联系我们';
$this->params['breadcrumbs'][] = $this->title;
empty($model) && $model = new Feedback();
?>
<div class="site-contact">
    <div class="row">

        <div class="col-lg-9">

            <?=(empty($page) || empty($page->content))?'':$page->content?>

            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                <div class="alert alert-success">
                    感谢您联系我们. 我们将尽快给您回复.
                </div>

                <p>
                    Note that if you turn on the Yii debugger, you should be able
                    to view the mail message on the mail panel of the debugger.
                    <?php if (Yii::$app->mailer->useFileTransport): ?>
                        Because the application is in development mode, the email is not sent but saved as
                        a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                                                                                                            Please configure the
                        <code>useFileTransport</code> property of the <code>mail</code>
                        application component to be false to enable email sending.
                    <?php endif; ?>
                </p>

            <?php else: ?>

                <p>如果您有什么问题, 请填写下面的表单联系我们。</p>
                <p>    谢谢。
                </p>

                <div class="row">
                    <div class="col-lg-12">

                        <?php $form = ActiveForm::begin(['id' => 'contact-form','action'=>['/site/contact']]); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($model, 'name')->textInput() ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($model, 'email') ?>
                            </div>
                        </div>
                        <?= $form->field($model, 'subject') ?>

                        <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('提交', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>

            <?php endif; ?>
        </div>
        <div class="col-lg-3">
            <?=\app\widgets\Category::widget(['type'=>\app\models\Content::TYPE_PRODUCTS,
                'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
            ])?>
            <?=\app\widgets\LastNews::widget(['options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
            ])?>
            <?=\app\widgets\ConfigPanel::widget(['configName'=>'contact_us',
                'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
            ])?>
            <?=\app\widgets\ConfigPanel::widget(['configName'=>'donate',
                'options'=>['class'=>'panel panel-default panel-'.\yii\helpers\ArrayHelper::getValue($this->params,'themeColor')]
            ])?>
        </div>
    </div>
</div>
