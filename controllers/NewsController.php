<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/10
 * Time: 13:31
 * Email:liyongsheng@meicai.cn
 */

namespace app\controllers;


use yii\web\Controller;
use app\models\News;
use yii\data\ActiveDataProvider;
use Yii;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
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
        $model = News::find()->where(['status'=>News::STATUS_ENABLE, 'id'=>$id])->one();
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
        $query = News::find()->where(['status'=>News::STATUS_ENABLE]);
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>Yii::$app->params['pageSize']]
        ]);

        return $this->render('list', [
            'searchModel' => new News(),
            'dataProvider' => $dataProvider
        ]);
    }
}