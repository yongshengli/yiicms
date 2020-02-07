<?php

// comment out the following two lines when deployed to production
define('YII_DEBUG', true);
define('YII_ENV', 'dev');
define('BASE_PATH', realpath(dirname(__DIR__)));

//define('ASSETS_DIR', __DIR__.'/assets');

require(BASE_PATH .'/vendor/autoload.php');
require(BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');
$config = require(BASE_PATH . '/config/web.php');
$app = new yii\web\Application($config);
$app->language = Yii::$app->session->get('language', 'zh-CN');
$app->run();
