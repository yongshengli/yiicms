<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/11
 * Time: 18:17
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\controllers;

use yii\filters\VerbFilter;
use app\modules\backend\components\BackendController;
use app\modules\backend\models\ProductsSearch;
use Yii;
use app\models\Products;
use yii\web\NotFoundHttpException;

class ProductsController extends BackendController
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
     * Lists all Content models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * Displays a single Content model.
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
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();
        $post = Yii::$app->request->post();
        if ($post) {
            $detailModel = $model->detail;
            $post[$model->formName()]['admin_user_id'] = Yii::$app->user->id;
            if ($model->load($post) && $model->save()) {
                $post[$detailModel->formName()]['content_id'] = $model->id;
                if($detailModel->load($post) && $detailModel->save()){
                    return $this->showMessage('添加成功','success');
                }else{
                    return $this->showMessage('添加产品详情失败');
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if($model->detail->load(Yii::$app->request->post()) && $model->detail->save()){
                return $this->showMessage('修改产品成功','success');
            }else{
                return $this->showMessage('修改产品详情失败');
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Content model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if($this->findModel($id)->delete()){
            return $this->showMessage('删除成功','success',['index']);
        }
        return $this->showMessage('删除失败');
    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}