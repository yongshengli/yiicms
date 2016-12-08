<?php

namespace app\modules\backend\controllers;
use app\modules\backend\components\BackendController;
use Yii;
use app\modules\backend\models\LoginForm;
use yii\filters\VerbFilter;

/**
 * Default controller for the `backend` module
 */
class DefaultController extends BackendController
{
    /**
     * 后台首页
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 登录页面
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'blank.php';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/backend/default/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/backend/default/login']);
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
}
