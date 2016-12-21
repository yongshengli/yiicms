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

class ProductsController extends Controller
{
    /**
     * 新闻详情页
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionIndex($id)
    {
        if(empty($id)){
            $this->redirect(['list']);
        }
        $model = Products::find()->where(['status'=>Products::STATUS_ENABLE, 'id'=>$id])->one();
        if(empty($model)){
            throw new NotFoundHttpException('你查看的页面不存在或者已删除');
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
        }
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>['defaultOrder'=>['id'=>SORT_DESC]],
            'pagination' => ['pageSize'=>Yii::$app->params['pageSize']]
        ]);

        return $this->render('list', [
            'searchModel' => new Products(),
            'dataProvider' => $dataProvider
        ]);
    }
}