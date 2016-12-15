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

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = '基础配置';

$this->params['breadcrumbs'][] = ['label' => '网站配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-config">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="config-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'appName')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pageSize')->textInput() ?>
        <?= $form->field($model, 'nav')->textarea() ?>
        <?=$model->getNav()?>
        <div class="form-group">
            <?= Html::submitButton('提交', ['class'=>'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
