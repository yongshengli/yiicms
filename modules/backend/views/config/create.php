<?php

use yii\helpers\Html;
use yii\widgets\Menu;

/* @var $this yii\web\View */
/* @var $model app\models\Config */

$this->title = '新建配置项';
$this->params['breadcrumbs'][] = ['label' => '配置管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-create">
    <div class="row">
        <div class="col-lg-10">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
        <div class="col-lg-2">
            <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
                <?= Menu::widget([
//                'template' => "\n<div>\n{items}\n</div>\n",
                    'activateParents'=>true,
                    'options' => ['class' => 'nav bs-docs-sidenav'],
                    'submenuTemplate' => "\n<ul class='nav'>\n{items}\n</ul>\n",
                    'items' => [
                        ['label' => '基础配置', 'url' => ['/backend/config/base-config']],
                        ['label' => '其他配置', 'url' => ['/backend/config/index'],
                            'items' => [
                                ['label' => '添加配置', 'url' => ['/backend/config/create']]
                            ]
                        ]
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>
