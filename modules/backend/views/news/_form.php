<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="content-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map($model->categorys,'id', 'name')) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList($model::$statusList) ?>
        </div>
    </div>
    <?= $form->field($model->detail, 'detail')->textarea(['rows'=>15]) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' =>'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
