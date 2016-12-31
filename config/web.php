<?php

$params = require(__DIR__ . '/params.php');
$view = require(__DIR__ . '/view.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Q-TAjtqKlLrK2nQLbeDDHBI00UPsApCB',
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'app\modules\backend\models\AdminUserIdentity',
            'enableAutoLogin' => false,
            'loginUrl'=>['backend/default/login']
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'formatter'=>[
            'class'=>'yii\i18n\Formatter',
            'defaultTimeZone'=>'Asia/Shanghai',
            'dateFormat'=>'php:Y-m-d',
            'timeFormat'=>'php:H:i:s',
            'datetimeFormat'=>'php:Y-m-d H:i:s'
        ],
        'view' =>&$view,
        'i18n' => [
            'class'=>'yii\i18n\I18N',
            'translations' => [
                'rbac-admin' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@mdm/admin/messages', // if advanced application, set @frontend/messages
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
    ],
    'params' => &$params,
    'language'=>'zh-CN',
    'modules' => [
        'backend' => [
            'class' => 'app\modules\backend\Module',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

if(isset($params['appName'])){
    $config['name'] = $params['appName'];
}
return $config;
