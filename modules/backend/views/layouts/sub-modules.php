<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/3
 * Time: 14:55
 * Email:liyongsheng@meicai.cn
 */
/** @var $this yii\web\View */
$this->registerCss('.box-body h1 {display:none}');
?>
<div class="box box-solid">
    <div class="box-header with-border"><h3 class="box-title"><?=$this->title?></h3></div>
    <div class="box-body">
        <?= $content ?>
    </div>
</div>
