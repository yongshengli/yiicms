<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/25
 * Time: 15:39
 * Email:liyongsheng@meicai.cn
 */
/* @var $model \app\models\PhotosDetail */
/* @var $this \yii\web\View*/
use yii\bootstrap\ActiveForm;
?>
<div class="col-lg-3 img-box">
    <?php $form = ActiveForm::begin(['action'=>['/backend/photos/edit-detail','id'=>$model->id]]); ?>
    <img src="<?=$model->file_url?>" class="img-thumbnail"/>
    <?=$form->field($model, 'content_id')->hiddenInput()?>
    <?=$form->field($model, 'file_url',['options'=>['style'=>'display:none']])->hiddenInput()?>
    <?=$form->field($model, 'detail')->textarea(['form-id'=>$form->getId(),'class'=>'form-control detail-input']);?>
    <?php ActiveForm::end(); ?>
</div>
<?php $this->registerJs('$(\'.detail-input\').blur(function(){
        var formId= $(this).attr(\'form-id\');
        $.ajax({
            "url":$("#"+formId).attr("action"),
            "type":"post",
            "dataType":"json",
            "data":new FormData($("#"+formId)[0]),
            processData: false,
            contentType: false
        }).done(function(){
//            alert(\'操作成功\');
        });
    });') ?>