<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
/* @var $this \yii\web\View */
?>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode($this->title);
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?= Breadcrumbs::widget([
                'homeLink'=>['label'=>'首页', 'url'=>['/backend/']],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?php if($this->context->module->id=='backend'):?>
            <?= $content ?>
        <?php else:?>
            <?php $this->beginContent('@app/modules/backend/views/layouts/sub-modules.php');?>
                <?= $content ?>
            <?php $this->endContent()?>
        <?php endif;?>
    </section>
</div>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y-', strtotime('-1year'));echo date('Y')?> <a href="http://yiicms.co">YiiCms</a>.</strong> All rights
    reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark" style="height: auto">
    <!-- Tab panes -->
    <div class="tab-content">
        <div id="control-sidebar-home-tab" class="tab-pane active">

        </div>
    </div>
</aside><!-- /.control-sidebar -->
<div class="control-sidebar-bg" style="position: fixed; height: auto;"></div>