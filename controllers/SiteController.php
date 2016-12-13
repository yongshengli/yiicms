<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Feedback;
use app\models\Config;
use yii\data\ActiveDataProvider;
use app\models\Products;

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
        $query = Products::find()->where(['status'=>Products::STATUS_ENABLE]);
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>Yii::$app->params['pageSize']]
        ]);

        return $this->render('index', [
            'searchModel' => new Products(),
            'dataProvider' => $dataProvider
        ]);
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
