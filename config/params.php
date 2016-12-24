<?php 
 return array (
  'appName' => 'YiiCms企业管理系统',
  'logo' => '@web/images/logo.png',
  'keywords' => '',
  'description' => '',
  'cacheDuration' => '0',
  'pageSize' => '2',
  'nav' => '{
    "options": {
        "class": "nav navbar-nav navbar-right"
    },
    "items": [
        {
            "label": "首页",
            "url": [
                "/site/index"
            ]
        },
        {
            "label": "产品",
            "url": [
                "/products/list"
            ],
            "activeUrls": [
                "/products/index"
            ]
        },
        {
            "label": "新闻",
            "url": [
                "/news/list"
            ],
            "activeUrls": [
                "/news/index"
            ]
        },
        {
            "label": "下载",
            "url": [
                "/downloads/list"
            ],
            "activeUrls": [
                "/downloads/index"
            ]
        },
        {
            "label": "关于我们",
            "url": [
                "/site/about"
            ],
            "items": [
                {
                    "label": "企业荣誉",
                    "url": {
                        "0":"/site/page/honor", "id":"honor"
                    }
                }
            ]
        },
        {
            "label": "联系我们",
            "url": [
                "/site/contact"
            ]
        }
    ]
}',
  'themeColor' => 'green',
);
