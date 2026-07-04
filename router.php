<?php
/**
 * Yii2 PHP Built-in Server Router
 * 用于 php -S 开发服务器
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// 如果请求的是真实存在的静态文件，直接返回
if ($uri !== '/' && file_exists(__DIR__ . '/web' . $uri)) {
    return false;
}

// 否则路由到 index.php
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/web/index.php';
$_SERVER['SCRIPT_NAME'] = '/index.php';

require_once __DIR__ . '/web/index.php';
