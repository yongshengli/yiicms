<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imageFile')->fileInput() ?>
    <?php if($model->image):?>
        <?= $form->field($model, 'image',['options'=>['style'=>'display:none']])->hiddenInput()?>
        <div><image src="<?=$model->image?>" class="img-responsive img-thumbnail" style="max-height: 200px;" alt="Responsive image"/></div>
    <?php endif?>
    <?= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
