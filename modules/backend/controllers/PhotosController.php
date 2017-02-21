<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/24
 * Time: 13:41
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\controllers;

use app\modules\backend\actions\ContentDeleteAllAction;
use app\modules\backend\actions\ContentCheckAction;
use app\models\PhotosDetail;
use app\modules\backend\components\BackendController;
use app\models\Photos;
use app\modules\backend\models\PhotosSearch;
use yii\filters\VerbFilter;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class PhotosController extends BackendController
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
                    'delete-detail' => ['POST'],
                    'edit-detail' => ['POST'],
                ],
            ],
        ];
    }
    public function actions()
    {
        return array_merge(parent::actions(), [
            'check'=>[
                'class'=>ContentCheckAction::className(),
                'type'=>Photos::$currentType,
                'status'=>Photos::STATUS_ENABLE
            ],
            'un-check'=>[
                'class'=>ContentCheckAction::className(),
                'type'=>Photos::$currentType,
                'status'=>Photos::STATUS_DISABLE
            ],
            'delete-all'=>[
                'class'=>ContentDeleteAllAction::className(),
                'type'=>Photos::$currentType,
            ]
        ]);
    }
    /**
     * Lists all Content models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhotosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $this->module->params['pageSize']);

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
        $model = $this->findModel($id);
        $detailModelList = PhotosDetail::find()->where(['content_id'=>$model->id])->all();
//        print_r($detailModelList);
        $newPhotoDetail = new PhotosDetail();
        $newPhotoDetail->content_id = $model->id;
        return $this->render('view', [
            'model' => $model,
            'detailModelList' =>$detailModelList,
            'newPhotoDetail' =>$newPhotoDetail,
        ]);
    }

    /**
     * 上传图片
     * @return array
     */
    public function actionUploadPhoto()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new PhotosDetail();
        if($model->load(Yii::$app->request->post()) && $model->uploadPhoto()){
            return [
                'code'=>0,
                'data'=>$this->renderPartial('_detail_item',['model'=>$model]),
            ];
        }
        return [
            'code'=>1,
            'data'=>empty($model->firstErrors)?'上传失败':$model->firstErrors,
        ];
    }

    /**
     * 设置相册封面
     * @param int $id
     * @return array
     */
    public function actionSetCover($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $detailModel = PhotosDetail::findOne($id);
        if(empty($detailModel)){
            return [
                'code'=>1,
                'data'=>'照片不存在'
            ];
        }
        $model = $detailModel->content;
        if(empty($model)){
            return [
                'code'=>1,
                'data'=>'相册不存在'
            ];
        }
        if($detailModel->setCover()){
            return [
                'code'=>0,
                'data'=>'操作成功'
            ];
        }
        return [
            'code'=>1,
            'data'=>empty($model->firstErrors)?'操作失败':$model->firstErrors,
        ];
    }

    /**
     * 修改照片详情
     * @param int $id
     * @return array
     */
    public function actionEditDetail($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = PhotosDetail::findOne($id);
        if($model->load(Yii::$app->request->post()) && $model->save()){
            return [
                'code'=>0,
                'data'=>'ok',
            ];
        }
        return [
            'code'=>1,
            'data'=>empty($model->firstErrors)?'修改失败':$model->firstErrors,
        ];
    }

    /**
     * @param $id
     * @return array
     */
    public function actionDeleteDetail($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = PhotosDetail::findOne($id);
        if(empty($model)){
            return [
                'code'=>1,
                'data'=>'图片不存在或者已删除',
            ];
        }
        try {
            $model->delete();
            return [
                'code' => 0,
                'data' => '删除成功',
            ];
        }catch(\Exception $e){
            return [
                'code' => 1,
                'data' => $e->getMessage(),
            ];
        }
    }
    /**
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Photos();
        $post = Yii::$app->request->post();
        if ($post) {
            if ($model->load($post) && $model->save()) {
                return $this->showFlash('添加成功','success');
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
            return $this->showFlash('修改新闻成功','success');
        }
        return $this->render('update', [
            'model' => $model,
        ]);

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
            return $this->showFlash('删除成功','success',['index']);
        }
        return $this->showFlash('删除失败', 'danger',Yii::$app->getUser()->getReturnUrl());
    }

    /**
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Photos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Photos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}