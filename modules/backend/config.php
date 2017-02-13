<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/7
 * Time: 15:00
 * Email:liyongsheng@meicai.cn
 */
$UEditor = require(__DIR__ . '/config/UEditor.php');
return [
    'components' => [
        // list of component configurations
        'UEditorAction'=>[
            'class'=>'kucha\ueditor\UEditorAction',
            'config'=>&$UEditor
        ],
//        'authManager' => [
//            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
//        ]
    ],
    'params' => [
        'pageSize' => '20',
    ],
    'UEditorConfigAction'=>'/backend/default/ueditor',
    'modules'=>[
        'rbac' => [
            'class' => 'mdm\admin\Module',
//            'layout' => 'left-menu', // it can be '@path/to/your/layout'.
//            'menus' => [
//                'assignment' => [
//                    'label' => 'Grand Access' // change label
//                ],
//                'route' => null, // disable menu route
//            ]
        ]
    ],
    'as access' => [
        'class' => 'app\modules\backend\components\AccessControl',
        'allowActions' => [
            'user/login',
        ]
    ],
];