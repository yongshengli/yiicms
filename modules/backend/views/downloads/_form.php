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
    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
    <?= $form->field($model, 'file')->fileInput()?>

    <?= !empty($model->detail->file_url)?$model->detail->file_url:''?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map($model->categorys,'id', 'name')) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList($model::$statusList) ?>
        </div>
    </div>

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