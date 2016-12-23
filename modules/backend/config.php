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
        ]
    ],
    'params' => [
        'pageSize' => '20',
    ],
];