<?php

// 通过环境变量控制 DEBUG 模式，默认为生产模式安全
define('YII_DEBUG', getenv('YII_DEBUG') === 'true');
define('YII_ENV', getenv('YII_ENV') ?: 'prod');
define('BASE_PATH', realpath(dirname(__DIR__)));

//define('ASSETS_DIR', __DIR__.'/assets');

require(BASE_PATH .'/vendor/autoload.php');
require(BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');
$config = require(BASE_PATH . '/config/web.php');
$app = new yii\web\Application($config);
$request = $app->getRequest();
$url = ltrim($request->getUrl(), "/");

$lan = substr($url, 0, strpos($url, '/'));
if (isset(app\models\Language::$lans[$lan])){
    $app->language = $lan;
    $request->setUrl(substr($url, strpos($url, '/')));
}else{
    $app->language = Yii::$app->session->get('language', 'zh-CN');
}

$app->run();
