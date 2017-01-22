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

<div class="file-preview-frame file-preview-initial">
    <?php $form = ActiveForm::begin(['action' => ['/backend/photos/edit-detail', 'id' => $model->id]]); ?>
    <div class="kv-file-content">
        <img src="<?= $model->file_url ?>" class="kv-preview-data file-preview-image"
             style="width:210px;height:160px;"/>
        <?= $form->field($model, 'content_id',['options'=>['style'=>'display:none']])->hiddenInput() ?>
        <?= $form->field($model, 'file_url', ['options' => ['style' => 'display:none']])->hiddenInput() ?>
        <?= $form->field($model, 'detail')->textarea(['form-id' => $form->getId(), 'class' => 'form-control detail-input']); ?>
    </div>
    <div class="file-thumbnail-footer">
        <div class="file-actions">
            <div class="file-footer-buttons">
<!--                <button type="button" class="kv-file-zoom btn btn-xs btn-default" title="查看详情">-->
<!--                    <i class="glyphicon glyphicon-zoom-in"></i>-->
<!--                </button>-->
                <button type="button" class="kv-file-bookmark btn btn-xs btn-default" title="设为封面" data-id="<?=$model->id?>">
                    <i class="fa fa-bookmark" style="color:#3c8dbc"></i>
                </button>
                <button type="button" class="kv-file-remove btn btn-xs btn-default" title="删除" data-id="<?=$model->id?>">
                    <i class="glyphicon glyphicon-trash" style="color:red"></i>
                </button>
            </div>
<!--            <div class="file-upload-indicator" title="没有上传">-->
<!--                <i class="glyphicon glyphicon-hand-down text-warning"></i>-->
<!--            </div>-->
            <div class="clearfix"></div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<!--设为封面-->
<?php $this->registerJs('
    $(\'.kv-file-bookmark\').click(function(){
        if(window.confirm(\'你确定要设此照片为封面？\')==false){
            return;
        }
        var id = $(this).data(\'id\');
        var self = this;
        if(!id){
            alert(\'参数错误\');
        }
        $.ajax({
            "url":"/backend/photos/set-cover?id="+id,
            "type":"post",
            "data":{"id":id},
            "dataType":"json"
        }).done(function(res){
            if(res.code!=0){
                alert(res.data);
                return;
            }
            alert(res.data);
        });
    });
')?>
<!--修改备注-->
<?php $this->registerJs(
'$(\'.detail-input\').change(function(){
    var formId= $(this).attr(\'form-id\');
    $.ajax({
        "url":$("#"+formId).attr("action"),
        "type":"post",
        "dataType":"json",
        "data":new FormData($("#"+formId)[0]),
        processData: false,
        contentType: false
    }).done(function(res){
        if(res.code!=0){
            alert(res.data);
        }
    });
});') ?>
<!--删除-->
<?php $this->registerJs('
$(\'.kv-file-remove\').click(function(){
    if(window.confirm(\'你确定要删除吗？\')==false){
        return;
    }
    var id = $(this).data(\'id\');
    var self = this;
    if(!id){
        alert(\'参数错误\');
    }
    $.ajax({
        "url":"/backend/photos/delete-detail?id="+id,
        "type":"post",
        "data":{"id":id},
        "dataType":"json"
    }).done(function(res){
        if(res.code!=0){
            alert(res.data);
            return;
        }
        alert(res.data);
        $(self).parents(\'.file-preview-frame\').remove();
    });
});') ?>