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
    <div class="row">
        <div class="col-lg-10">
            <h1><?= Html::encode($this->title) ?></h1>

            <div class="config-form">

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'appName')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'logo')->textInput(['maxlength' => true])
                    ->label($model->getAttributeLabel('logo').'<code>如：@web/images/logo.png</code>')
                ?>

                <?= $form->field($model, 'keywords')->textarea() ?>

                <?= $form->field($model, 'description')->textarea() ?>

                <?= $form->field($model, 'pageSize')->textInput() ?>

                <?= $form->field($model, 'cacheDuration')->textInput() ?>

                <?= $form->field($model, 'nav')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'themeColor')->dropDownList($model->themeColors) ?>

                <div class="form-group">
                    <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
        <div class="col-lg-2">
            <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
                <?= Menu::widget([
//                'template' => "\n<div>\n{items}\n</div>\n",
                    'options' => ['class' => 'nav bs-docs-sidenav'],
                    'submenuTemplate' => "\n<ul class='nav'>\n{items}\n</ul>\n",
                    'items' => [
                        ['label' => '基础配置', 'url' => ['/backend/config/base-config']],
                        ['label' => '其他配置', 'url' => ['/backend/config/index']]
                    ]
                ]) ?>
            </div>
        </div>

    </div>
</div>
