<?php

namespace app\controllers;

use app\models\Content;
use Yii;
use app\components\AppController as Controller;
use app\models\Feedback;
use app\models\Config;
use yii\data\ActiveDataProvider;
use app\models\Products;
use app\models\Ad;

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
        $products = Products::find()->where(['status'=>Products::STATUS_ENABLE])->orderBy('id desc')->limit(12)->all();
        $aboutUs = Config::find()->where(['name'=>'about_us'])->one();
        return $this->render('index', [
            'aboutUs'=>$aboutUs,
            'products' => $products,
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
    public function actionSearch()
    {
        $keyword = Yii::$app->request->get('keyword');
//        if(empty($keyword)){
////            $this->;
//        }
        $query = Content::find()
            ->andFilterWhere(['in', 'type', [Content::TYPE_NEWS,Content::TYPE_PRODUCTS]])
            ->andFilterWhere(['like', 'title', $keyword])
            ->andFilterWhere(['status'=>Content::STATUS_ENABLE]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>Yii::$app->params['pageSize']]
        ]);
        $this->view->params['keyword'] = $keyword;
        return $this->render('search', [
            'searchModel' => new Content(),
            'dataProvider' => $dataProvider
        ]);
    }
}
