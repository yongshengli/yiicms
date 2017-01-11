<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PhotosDetail */
/* @var $form yii\widgets\ActiveForm */
$this->registerJs('
    $(\'#image-file\').change(function () {
        $(\'.overlay\').show();
        $.ajax({
            "url":$("#upload-form").attr("action"),
            "type":"post",
            "dataType":"json",
            "data":new FormData($(\'#upload-form\')[0]),
            processData: false,
            cache: false,
            contentType: false
        }).done(function (res) {
            if (res.code == 1) {
                alert(\'上传失败\');
                return false;
            }
            $(\'#photo-list\').append(res.data);
            alert("上传图片成功");
            $(\'.overlay\').hide();
        });
    });
');
?>

<div class="detail-form">
    <?php $form = ActiveForm::begin(
        [
            'options' => ['enctype' => 'multipart/form-data'],
            'action'=>['/backend/photos/upload-photo'],
            'id'=>'upload-form'
        ]); ?>
    <?= $form->field($model, 'content_id',['options'=>['style'=>'display:none']])->hiddenInput()?>
    <a href="javascript:;" class="btn btn-block btn-primary" style="position:relative;cursor:pointer;overflow:hidden;display:inline-block;*display:inline;">
        <i class="fa fa-upload">上传照片</i>
        <input name="PhotosDetail[imageFile]" id="image-file" type="file" style="position: absolute;font-size: 100px;right: 0;top: 0;opacity: 0;"/>
    </a>
    <?php ActiveForm::end(); ?>

</div>