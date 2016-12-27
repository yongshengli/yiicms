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
    ],
    'params' => [
        'pageSize' => '5',
    ],
    'modules'=>[
        'rabc' => [
            'class' => 'mdm\admin\Module',
//            'layout' => 'left-menu', // it can be '@path/to/your/layout'.
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                'route' => null, // disable menu route
            ]
        ]
    ],
];