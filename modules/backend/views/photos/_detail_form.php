<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="detail-form">
    <?php $form = ActiveForm::begin(
        [
            'options' => ['enctype' => 'multipart/form-data'],
            'action'=>['/backend/photos/upload-photo']
        ]); ?>
    <?= $form->field($model, 'content_id')->hiddenInput()?>
    <?= $form->field($model, 'imageFile')->fileInput(['onchange'=>'this.form.submit()'])?>
    <?php ActiveForm::end(); ?>

</div>
