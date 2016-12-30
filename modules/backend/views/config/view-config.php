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
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'themePath')->dropDownList($model->themes) ?>

    <?= $form->field($model, 'themeColor')->dropDownList($model->themeColors) ?>

    <div class="form-group">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
