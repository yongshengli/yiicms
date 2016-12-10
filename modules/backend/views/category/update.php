<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = '修改分类: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '分类管理', 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = '修改';
?>
<div class="category-update">
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
                    'submenuTemplate' => "\n<ul class='nav'>\n{items}\n</ul>\n",
                    'items' => [
                        ['label' => '新闻管理', 'url' => ['/backend/news/index'],
                            'items' => [
                                ['label' => '添加新闻', 'url' => ['/backend/news/create']]
                            ]
                        ],
                        ['label' => '分类管理', 'url' => ['/backend/category/index', 'type' => app\models\Content::TYPE_NEWS],
                            'active'=>true,
                            'items' => [
                                ['label' => '新建分类', 'url' => ['/backend/category/create', 'type' => app\models\Content::TYPE_NEWS]]
                            ]
                        ],
                    ]
                ]) ?>
            </div>
        </div>
    </div>
</div>
