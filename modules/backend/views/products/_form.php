<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="content-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'imageFile')->widget(
        FileInput::class,
        [
            'pluginOptions' => [
                'showUpload' => false,
                'initialPreview' => empty($model->image)?'':[\yii\helpers\Url::to($model->image)],
                'initialPreviewAsData' => true,
            ],
            'pluginEvents' => [
                "fileclear" => "function() { $('#products-image').val('');}",
            ],
        ]
    ) ?>
    <?= $form->field($model, 'image',['options'=>['style'=>'display:none']])->hiddenInput(['id'=>'products-image'])?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'category_id')->widget(Select2::className(),['data'=>(new \app\helpers\CategoryHelper(['categories'=>$model->categories]))->getKV()]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList($model::$statusList) ?>
        </div>
    </div>
    <?= $form->field($model->detail, 'params')->widget(\kucha\ueditor\UEditor::className(),[
        'clientOptions'=>[
            'serverUrl'=>yii\helpers\Url::to([$this->context->module->UEditorConfigAction]),
            'initialFrameHeight'=>'100'
        ]
    ]) ?>
    <?= $form->field($model->detail, 'detail')->widget(\kucha\ueditor\UEditor::className(), [
        'clientOptions' => [
            'serverUrl'=>yii\helpers\Url::to([$this->context->module->UEditorConfigAction]),
            'initialFrameHeight' => '200'
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>