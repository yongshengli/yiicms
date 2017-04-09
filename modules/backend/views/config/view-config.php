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

$this->title = '模板主题配置';

$this->params['breadcrumbs'][] = ['label' => '模板主题配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="base-config">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation"><?= Html::a('基础配置', ['base-config']) ?></li>
            <li role="presentation" class="active"><?= Html::a('模板配置', ['view-config']) ?></li>
            <li role="presentation"><?= Html::a('其他配置', ['index']) ?></li>
            <li role="presentation"><?= Html::a('添加配置', ['create']) ?></li>
        </ul>
        <div class="tab-content">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'themePath')->dropDownList($model->themes) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'themeColor')->dropDownList($model->themeColors) ?>
                </div>
            </div>
            <div class="form-group">
                <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
