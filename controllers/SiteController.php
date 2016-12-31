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
use yii\web\NotFoundHttpException;
use app\models\Page;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheDuration'],
                'only'=>['index', 'about'],
                'variations' => [
                    \Yii::$app->language,
                ]
            ],
        ];
    }
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
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionAbout()
    {
        $config = Config::find()->where(['name'=>'about_us'])->one();
        if(empty($config)){
            throw new NotFoundHttpException('页面不存在');
        }
        return $this->actionPage($config['value']);
    }
    /**
     * Displays products page
     *
     * @return string
     */
    public function actionSearch()
    {
        $keyword = Yii::$app->request->get('keyword');
        Content::$currentType = null;
        $query = Content::find()
            ->andFilterWhere(['or',['like', 'title', $keyword],['like', 'description', $keyword]])
            ->andFilterWhere(['status'=>Content::STATUS_ENABLE]);
//        echo $query->createCommand()->getRawSql();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['id'=>SORT_DESC]],
            'pagination' => ['pageSize'=>Yii::$app->params['pageSize']]
        ]);
        $this->view->params['keyword'] = $keyword;
        return $this->render('search', [
            'searchModel' => new Content(),
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * config 页面
     * @param int $id
     * @throws NotFoundHttpException
     * @return string
     */
    public function actionPage($id)
    {
        $model = Page::find()->where(['name'=>$id])->one();
        if(empty($model)){
            throw new NotFoundHttpException('页面不存在');
        }
        if(!empty($model->keywords)){
            $this->view->registerMetaTag(['name'=>'keywords', 'content'=>$model->keywords],'keywords');
        }
        if(!empty($model->description)){
            $this->view->registerMetaTag(['name'=>'description', 'content'=>$model->description], 'description');
        }
        return $this->render($model->template,[
            'model'=>$model
        ]);
    }

}
