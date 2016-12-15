<?php

return [
    'appName'=>'YiiCms企业管理系统',
//    'adminEmail' => '739800600@qq.com',
    'pageSize' =>20,
    'logo'=>'@web/images/logo.png',
    'nav'=>[
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => '产品', 'url' => ['/products/list'],
                'active'=>function(){return Yii::$app->controller->id=='products';}
            ],
            ['label' => '新闻', 'url' => ['/news/list'],
                'active'=>function(){return Yii::$app->controller->id=='news';}
            ],
            ['label' => '关于我们', 'url' => ['/site/about'],],
            ['label' => '联系我们', 'url' => ['/site/contact']],
        ],
    ],
];
