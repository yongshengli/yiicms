<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Feedback;
use app\models\Config;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new Feedback();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(isset(Yii::$app->params['adminEmail'])) {
                $model->sendEmail(Yii::$app->params['adminEmail']);
                Yii::$app->session->setFlash('contactFormSubmitted');
            }
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $model = Config::find()->where(['name'=>'about_us'])->one();
        return $this->render('about',[
            'model'=>$model
        ]);
    }
    /**
     * Displays products page
     *
     * @return string
     */
    public function actionProducts()
    {
        return $this->render('products');
    }
}
