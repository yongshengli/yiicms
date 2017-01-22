<?php

namespace app\modules\backend\controllers;

use app\models\Content;
use Yii;
use app\models\Category;
use app\modules\backend\models\CategorySearch;
use app\modules\backend\components\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BackendController
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
     * Lists all Category models.
     * @param int $type
     * @return mixed
     */
    public function actionIndex($type)
    {
        $searchModel = new CategorySearch();
        $params = Yii::$app->request->queryParams;
        $params[$searchModel->formName()]['type'] = $type;

        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'type'=>$type,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @param int $type
     * @return mixed
     */
    public function actionCreate($type)
    {
        $model = new Category();
        $model->type = $type;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->showFlash('添加分类成功','success');
        } else {
            return $this->render('create', [
                'model' => $model,
                'type'=>$type,
            ]);
        }
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->showFlash('修改分类成功','success');
        } else {
            return $this->render('update', [
                'model' => $model,
                'type'=>$model->type,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        Content::$currentType =null;
        $content = Content::find()->where(['category_id'=>$id])->limit(1)->one();
        if($content){
            return $this->showFlash('此分类下有内容，不可删除', Yii::$app->getUser()->getReturnUrl());
        }
        if($model->delete()){
            return $this->showFlash('删除成功','success', Yii::$app->getUser()->getReturnUrl());
        }
        return $this->showFlash('删除失败','danger', Yii::$app->getUser()->getReturnUrl());
    }

    /**
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
