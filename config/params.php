<?php
return array(
    'appName' => 'YiiCms企业管理系统',
    'pageSize' => '20',
    'logo' => '@web/images/logo.png',
    'keywords'=>'',
    'description'=>'',
    'nav' =>
        array(
            'options' =>
                array(
                    'class' => 'navbar-nav',
                ),
            'items' =>
                array(
                    0 =>
                        array(
                            'label' => '产品',
                            'url' =>
                                array(
                                    0 => '/products/list',
                                ),
                            'activeUrls' =>
                                array(
                                    0 => '/products/index',
                                ),
                        ),
                    1 =>
                        array(
                            'label' => '新闻',
                            'url' =>
                                array(
                                    0 => '/news/list',
                                ),
                            'activeUrls' =>
                                array(
                                    0 => '/news/index',
                                ),
                        ),
                    2 =>
                        array(
                            'label' => '关于我们',
                            'url' =>
                                array(
                                    0 => '/site/about',
                                ),
                        ),
                    3 =>
                        array(
                            'label' => '联系我们',
                            'url' =>
                                array(
                                    0 => '/site/contact',
                                ),
                        ),
                ),
        ),
);
