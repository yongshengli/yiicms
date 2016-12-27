<?php
use app\models\Content;
?>
<aside class="main-sidebar">

    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
//                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => '产品管理','icon' => 'fa fa-circle-o', 'url' => '#',
                        'items' => [
                            ['label' => '产品管理', 'url' => ['/backend/products/index'],],
                            ['label' => '分类管理', 'url' => ['/backend/category/index','type'=>Content::TYPE_PRODUCTS]],
                        ]
                    ],
                    ['label' => '新闻管理', 'icon' => 'fa fa-newspaper-o','url' => ['/backend/news/index'],
                        'items' => [
                            [
                                'label' => '新闻管理', 'url' => ['/backend/news/index'],
                            ],
                            ['label' => '分类管理', 'url' => ['/backend/category/index','type'=>Content::TYPE_NEWS]],
                        ]
                    ],
                    ['label' => '照片管理','icon' => 'fa fa-picture-o', 'url' => ['/backend/photos/index'],
                        'items' => [
                            [
                                'label' => '相册管理', 'url' => ['/backend/photos/index'],
                            ],
                            ['label' => '分类管理', 'url' => ['/backend/category/index','type'=>Content::TYPE_PHOTOS]],
                        ]
                    ],
                    ['label' => '下载管理', 'icon' => 'fa fa-download','url' => ['/backend/downloads/index'],
                        'items' => [
                            [
                                'label' => '下载管理', 'url' => ['/backend/downloads/index'],
                            ],
                            ['label' => '分类管理', 'url' => ['/backend/category/index','type'=>Content::TYPE_DOWNLOADS]],
                        ]
                    ],
                    ['label' => '用户反馈', 'icon' => 'fa fa-envelope-o','url' => ['/backend/feedback/index'],],
                    ['label' => '网站配置', 'icon' => 'fa fa-cog','url' => ['/backend/config/index'],
                        'items' => [
                            ['label' => '基础配置', 'url' => ['/backend/config/base-config']],
                            ['label' => '其他配置', 'url' => ['/backend/config/index'],]
                        ]
                    ],
                    ['label' => '轮播图管理','icon' => 'fa fa-share', 'url' => ['/backend/ad/index'],],
                    ['label' => '管理员权限', 'icon' => 'fa fa-user-secret','url' => '#',
                        'items' => [
                            ['label' => '管理员配置', 'url' => ['/backend/admin-user/index']],
                            ['label' => '权限配置', 'url' => ['/backend/rbac'],],
                            ['label' => '角色列表', 'url' => ['/backend/rbac/role'],],
                            ['label' => '权限列表', 'url' => ['/backend/rbac/permission'],],
                            ['label' => '规则列表', 'url' => ['/backend/rbac/rule'],],
                        ]
                    ],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Same tools',
                        'icon' => 'fa fa-share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'fa fa-circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'fa fa-circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'fa fa-circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
