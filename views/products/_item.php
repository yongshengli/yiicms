<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/12
 * Time: 21:43
 * Email:liyongsheng@meicai.cn
 */
use yii\helpers\Url;
?>
<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <a href="<?=Url::to(['/products/', 'id'=>$model->id])?>">
            <img data-src="holder.js/300x300" alt="<?=$model->title?>" src="<?=$model->image?>" style="width:242px;height:200px">
        </a>
        <div class="caption">
            <h5>
                <a href="<?=Url::to(['/products/', 'id'=>$model->id])?>"><?=$model->title?></a>
            </h5>
            <div>
                <p><?=$model->description?></p>
            </div>
        </div>
    </div>
</div>
