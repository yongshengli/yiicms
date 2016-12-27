<?php

namespace app\modules\backend;
use Yii;
/**
 * backend module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\backend\controllers';
    public $layout = 'main.php';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::configure($this, require(__DIR__ . '/config.php'));
        // custom initialization code goes here
        if(Yii::$app->user->isGuest && Yii::$app->requestedRoute!='backend/default/login'){
            return Yii::$app->response->redirect(['backend/default/login']);
        }
        Yii::$container->set('mdm\admin\components\Configs',['db' => 'customDb', 'menuTable' => 'admin_menu',]);
    }
}
