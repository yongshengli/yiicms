<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/15
 * Time: 18:22
 * Email:liyongsheng@meicai.cn
 */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Menu;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = '基础配置';

$this->params['breadcrumbs'][] = ['label' => '网站配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-config">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><?= Html::a('基础配置', ['base-config']) ?></li>
            <li role="presentation"><?= Html::a('模板配置', ['view-config']) ?></li>
            <li role="presentation"><?= Html::a('其他配置', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加配置', ['create']) ?></li>
        </ul>
        <div class="tab-content">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'appName')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'logo')->textInput(['maxlength' => true])
                ->label($model->getAttributeLabel('logo') . '<code>如：@web/images/logo.png</code>')
            ?>

            <?= $form->field($model, 'homeTitle')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'keywords')->textarea() ?>

            <?= $form->field($model, 'description')->textarea() ?>

            <?= $form->field($model, 'pageSize', ['inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon">条</span></div>'])
                ->textInput() ?>

            <?= $form->field($model, 'cacheDuration', ['inputTemplate' => '<div class="input-group">{input}<span class="input-group-addon">秒</span></div>'])
                ->textInput() ?>

            <?= $form->field($model, 'nav')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
