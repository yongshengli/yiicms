<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/16
 * Time: 10:06
 * Email:liyongsheng@meicai.cn
 */

namespace app\components;


use yii\web\Controller;
use Yii;
use app\models\Ad;

class AppController extends Controller
{
    public function init(){
        parent::init();
        if(isset(Yii::$app->params['keywords'])){
            $this->view->registerMetaTag(['name'=>'keywords', 'content'=>Yii::$app->params['keywords']], 'keywords');
        }
        if(isset(Yii::$app->params['description'])){
            $this->view->registerMetaTag(['name'=>'description', 'content'=>Yii::$app->params['description']], 'description');
        }
        $this->view->params['adList'] = Ad::getDb()->cache(function(){
            return Ad::find()->asArray()->all();
        }, Yii::$app->params['cacheDuration']);

        $this->pageCache();
    }

    /**
     * 设置缓存
     */
    protected function pageCache()
    {
        if (isset(Yii::$app->params['cacheDuration']) && Yii::$app->params['cacheDuration'] >= 0) {
            $cacheConfig = [
                'class' => 'yii\filters\PageCache',
                'duration' => Yii::$app->params['cacheDuration'],
                'variations' => [
                    \Yii::$app->language,
                    Yii::$app->request->get()
                ]
            ];
            $this->attachBehavior('pageCache', $cacheConfig);
        }
    }
}