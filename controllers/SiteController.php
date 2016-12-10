<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\FeedbackForm;
use app\models\News;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    const PAGE_SIZE = 10;
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
        $model = new FeedbackForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

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
        return $this->render('about');
    }

    /**
     * Displays news page
     *
     * @return string
     */
    public function actionNews()
    {
        $query = News::find();
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>self::PAGE_SIZE]
        ]);

        return $this->render('news', [
            'searchModel' => new News(),
            'dataProvider' => $dataProvider
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
