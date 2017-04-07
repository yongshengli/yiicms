<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/11
 * Time: 14:27
 * Email:liyongsheng@meicai.cn
 */

namespace app\controllers;


use app\components\AppController;
use app\models\Photos;
use app\models\PhotosDetail;
use yii\web\NotFoundHttpException;
use Yii;
use yii\data\ActiveDataProvider;
use app\models\Category;

class PhotosController extends AppController
{
    /**
     * 相册详情
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        $id = Yii::$app->request->get('id');
        if(empty($id)){
            return $this->redirect(['list']);
        }
        return $this->actionItem($id);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionItem($id)
    {
        $model = Photos::find()->where(['status'=>Photos::STATUS_ENABLE,'id'=>$id])->one();
        if(empty($model)){
            throw new NotFoundHttpException('你查看的页面不存在或者已删除');
        }
        if(!empty($model->keywords)){
            $this->view->registerMetaTag(['name'=>'keywords', 'content'=>$model->keywords],'keywords');
        }
        if(!empty($model->description)){
            $this->view->registerMetaTag(['name'=>'description', 'content'=>$model->description], 'description');
        }
        $query = PhotosDetail::find()->where(['content_id'=>$id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['id'=>SORT_ASC]],
            'pagination' => ['pageSize'=>1]
        ]);
//        print_r($dataProvider->pagination->getLinks());
        return $this->render('index', [
            'model'=>$model,
            'searchModel'=> new PhotosDetail(),
            'dataProvider' => $dataProvider
        ]);
    }
    public function actionList()
    {
        $categoryId = Yii::$app->request->get('category-id');
        $query = Photos::find()->where(['status'=>Photos::STATUS_ENABLE]);
        if($categoryId){
            $query->andWhere(['category_id'=>$categoryId]);
            $category = Category::findOne($categoryId);
        }else{
            $category = new Category();
            $category->type = Photos::$currentType;
        }
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['id'=>SORT_DESC]],
            'pagination' => ['pageSize'=>Yii::$app->params['pageSize']]
        ]);

        return $this->render('list', [
            'category'=>$category,
            'searchModel' => new Photos(),
            'dataProvider' => $dataProvider
        ]);
    }
}