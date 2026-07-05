<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/5
 * Time: 13:23
 * Email:739800600@qq.com
 */
namespace app\modules\backend\actions;

use app\models\Content;
use app\models\ContentQuery;
use yii\base\Action;
use Yii;
use yii\base\Exception;
use yii\base\ErrorException;
use yii\web\Response;

/**
 * Class ContentActions
 * @property \app\modules\backend\components\BackendController $controller
 * @package app\modules\backend\actions
 */
class ContentCheckAction extends Action
{

    /** @var int 审核通过 */
    public $status = null;
    public $type = null;

    public function init()
    {
        parent::init();
        if($this->type === null){
            throw new ErrorException('type 不能为空');
        }
        if($this->status === null){
            throw new ErrorException('status 不能为空');
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
        $attr = ['status'=>$this->status];

        try {
            Content::updateAll($attr, ['and', ['in', 'id', $ids], ['type' => $this->type]]);
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