<?php

namespace app\modules\backend;
use Yii;
use yii\web\ForbiddenHttpException;

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
//        if(Yii::$app->user->isGuest && Yii::$app->requestedRoute!='backend/default/login'){
//            return Yii::$app->response->redirect(['backend/default/login']);
//        }
//        Yii::$container->clear('errorHandler');
        Yii::$container->set(
            'errorHandler', [
                'class'=>'yii\web\ErrorHandler',
                'errorAction' => 'backend/default/error',
            ]
        );
        Yii::$container->set('mdm\admin\components\Configs',
            [
                'db' => 'customDb',
                'menuTable' => 'admin_menu',
                'userTable' => 'admin_user',
            ]
        );
    }
}
