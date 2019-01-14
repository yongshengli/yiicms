<?php

// comment out the following two lines when deployed to production
define('YII_DEBUG', true);
define('YII_ENV', 'dev');
//define('ASSETS_DIR', __DIR__.'/assets');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

$app = new yii\web\Application($config);
$app->language = Yii::$app->session->get('language', 'zh-CN');
$app->run();
