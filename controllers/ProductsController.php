<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/11
 * Time: 21:42
 * Email:liyongsheng@meicai.cn
 */

namespace app\controllers;

use yii\web\NotFoundHttpException;
use app\models\Products;
use app\components\AppController as Controller;
use yii\data\ActiveDataProvider;
use Yii;
use app\models\Category;

class ProductsController extends Controller
{
    /**
     * 产品首页
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

        $model = Products::find()->where(['status'=>Products::STATUS_ENABLE, 'id'=>$id])->one();

        if(empty($model)){
            throw new NotFoundHttpException('你查看的页面不存在或者已删除');
        }
        if(!empty($model->keywords)){
            $this->view->registerMetaTag(['name'=>'keywords', 'content'=>$model->keywords],'keywords');
        }
        if(!empty($model->description)){
            $this->view->registerMetaTag(['name'=>'description', 'content'=>$model->description], 'description');
        }

        return $this->render('index',['model'=>$model]);
    }
    /**
     * Displays news page
     *
     * @return string
     */
    public function actionList()
    {
        $categoryId = Yii::$app->request->get('category-id');
        $query = Products::find()->where(['status'=>Products::STATUS_ENABLE]);
        if($categoryId){
            $query->andWhere(['category_id'=>$categoryId]);
            $category = Category::findOne($categoryId);
        }else{
            $category = new Category();
            $category->type = Products::$currentType;
        }
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['id'=>SORT_DESC]],
            'pagination' => ['pageSize'=>Yii::$app->params['pageSize']]
        ]);

        return $this->render('list', [
            'category'=>$category,
            'searchModel' => new Products(),
            'dataProvider' => $dataProvider
        ]);
    }
}