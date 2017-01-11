<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/12
 * Time: 21:43
 * Email:liyongsheng@meicai.cn
 */
/** @var $model app\models\Products */
use yii\helpers\Url;
use app\helpers\StringHelper;
?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <div class="image-box">
            <a href="<?=Url::to(['/photos/', 'id'=>$model->id])?>">
                <img alt="<?=$model->title?>" src="<?=$model->image?>" class="image">
            </a>
        </div>
        <div class="caption">
            <h5>
                <a href="<?=Url::to(['/photos/', 'id'=>$model->id])?>" title="<?=$model->title?>">
                    <?=StringHelper::truncateUtf8String($model->title, 13, false)?>
                </a>
            </h5>
            <div style="height: 40px;overflow: hidden;">
                <?=$model->description?>
            </div>
        </div>
    </div>
</div>
