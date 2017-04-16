<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\CategoryHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'pid')->widget(\kartik\select2\Select2::className(),[
                'data'=>(new CategoryHelper(['categories'=>$model->getPossibleParentArr()]))->getKV()
            ]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'imageFile')->widget(
        FileInput::class,
        [
            'pluginOptions' => [
                'showUpload' => false,
                'initialPreview' => empty($model->image)?'':[\yii\helpers\Url::to($model->image)],
                'initialPreviewAsData' => true,
            ],
            'pluginEvents' => [
                "fileclear" => "function() { $('#category-image').val('');}",
            ],
        ]
    ) ?>
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'image',['options'=>['style'=>'display:none']])->hiddenInput(['id'=>'category-image'])?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '提交' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
