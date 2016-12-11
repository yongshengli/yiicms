<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\News */

$this->title = '添加产品';
$this->params['breadcrumbs'][] = ['label' => '产品管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-create">
    <div class="row">
        <div class="col-lg-10">
            <h1><?= Html::encode($this->title) ?></h1>

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
        <div class="col-lg-2">
            <div class="bs-docs-sidebar hidden-print hidden-xs hidden-sm affix">
                <?= yii\widgets\Menu::widget([
//                'template' => "\n<div>\n{items}\n</div>\n",
                    'options' => ['class' => 'nav bs-docs-sidenav'],
                    'submenuTemplate'=>"\n<ul class='nav'>\n{items}\n</ul>\n",
                    'items' => [
                        ['label' => '产品管理', 'url' => ['/backend/products/index'],'active'=>true,
                            'items'=>[
                                ['label'=>'添加产品','url'=>['/backend/products/create'],'active'=>true]
                            ]
                        ],
                        ['label' => '分类管理', 'url' => ['/backend/category/index', 'type' => app\models\Content::TYPE_PRODUCTS]],
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>
