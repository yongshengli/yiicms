<?php

namespace app\modules\backend\controllers;

use app\modules\backend\models\BaseConfig;
use Yii;
use app\models\Config;
use app\modules\backend\models\ConfigSearch;
use app\modules\backend\components\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\backend\models\ViewConfig;

/**
 * ConfigController implements the CRUD actions for Config model.
 */
class ConfigController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Config models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Config model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Config model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Config();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->showFlash('添加成功', 'success');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Config model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->showFlash('修改成功','success');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Config model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()){
            return $this->showFlash('删除成功','success', ['index']);
        }
        return $this->showFlash('删除失败','danger',Yii::$app->getUser()->getReturnUrl());
    }

    /**
     * 主题配置
     * @return string|\yii\web\Response
     */
    public function actionViewConfig()
    {
        $model = new ViewConfig();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->showFlash('操作成功', 'success');
        }
        return $this->render('view-config',[
            'model'=>$model
        ]);
    }
    /**
     * 基础配置
     */
    public function actionBaseConfig()
    {
        $model = new BaseConfig();
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->showFlash('操作成功', 'success');
        }
        return $this->render('base-config',[
            'model'=>$model
        ]);
    }
    /**
     * Finds the Config model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Config the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Config::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
