<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'file')->widget(
        FileInput::class,
        [
            'pluginOptions' => [
                'showUpload' => false,
                'showPreview'=>false,
                'showRemove'=>false,
                'initialPreview' => empty($model->detail->file_url)?'':[\yii\helpers\Url::to($model->detail->file_url)],
                'initialPreviewAsData' => true,
            ],
        ]
    ) ?>
    <?= $form->field($model->detail, 'file_url',['options'=>['style'=>'display:none']])->hiddenInput()?>

    <?= !empty($model->detail->file_url)?$model->detail->file_url:''?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'category_id')->widget(Select2::class,['data'=>(new \app\helpers\CategoryHelper(['categories'=>$model->categories]))->getKV()]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList($model::$statusList) ?>
        </div>
    </div>

    <?= $form->field($model->detail, 'detail')->widget(\kucha\ueditor\UEditor::className(), [
        'clientOptions' => [
            'serverUrl'=>yii\helpers\Url::to('/backend/default/ueditor'),
            'initialFrameHeight' => '200'
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>