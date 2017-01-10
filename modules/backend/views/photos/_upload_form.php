<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\News */
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
    <?= $form->field($model, 'content_id')->hiddenInput()?>
    <?= $form->field($model, 'imageFile')->fileInput(['id'=>'image-file'])?>
    <?php ActiveForm::end(); ?>

</div>
<script>

</script>