<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/5
 * Time: 13:49
 * Email:739800600@qq.com
 */

namespace app\modules\backend\actions;

use yii\base\Action;
use app\models\Content;
use app\models\ContentQuery;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;
use yii\web\Response;
/**
 * Class ContentDeleteAllAction
 * @property \app\modules\backend\components\BackendController $controller
 * @package app\modules\backend\actions
 */
class ContentDeleteAllAction extends Action
{

    public $type = null;

    public function init()
    {
        parent::init();
        if($this->type === null){
            throw new ErrorException('type 不能为空');
        }
    }

    /**
     * @return array
     */
    public function run()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $ids =  Yii::$app->request->post('ids');
        if(empty($ids)){
            return ['data'=>'id不能为空','code'=>1];
        }
        $originalType = Content::$currentType;
        Content::$currentType = $this->type;

        try {
            // 逐条删除以触发 afterDelete() 清理关联的 ContentDetail
            $models = Content::findAll($ids);
            foreach ($models as $model) {
                $model->delete();
            }
            Content::$currentType = $originalType;
            return [
                'code'=>0,
                'data'=>'操作成功'
            ];
        }catch(Exception $e){
            Content::$currentType = $originalType;
            return [
                'code'=>1,
                'data'=>$e->getMessage()
            ];
        }
    }
}