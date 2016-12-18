<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="content-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'imageFile')->fileInput()?>
    <?php if($model->image):?>
        <?= $form->field($model, 'image',['options'=>['style'=>'display:none']])->hiddenInput()?>
        <div style="position: relative;">
            <image src="<?= $model->image ?>" class="img-responsive img-thumbnail"
                   style="max-height: 200px;" alt="Responsive image" />
            <div id="source-button"><a onclick="removeImage(this)"><span class="glyphicon glyphicon-trash"></span></a></div>
        </div>
    <?php endif?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map($model->categorys,'id', 'name')) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList($model::$statusList) ?>
        </div>
    </div>
    <?= $form->field($model, 'description')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <?= $form->field($model->detail, 'detail')->widget(\yii\redactor\widgets\Redactor::className()) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function removeImage(obj){
        if(window.confirm('确认要删除图片吗？')) {
            $('#products-image').val('');
            $(obj).parent().parent().remove();
        }
    }
</script>