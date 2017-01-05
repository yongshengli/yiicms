<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/5
 * Time: 13:49
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\actions;

use yii\base\Action;
use app\models\Content;
use app\models\ContentQuery;
use Yii;
use yii\base\ErrorException;
use yii\base\Exception;

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
     * @return \yii\web\Response
     */
    public function run()
    {
        $ids =  Yii::$app->request->post('selection');
        if(empty($ids)){
            return $this->controller->showFlash('id不能为空','warning',Yii::$app->user->getReturnUrl());
        }
        Content::$currentType = $this->type;

        /** @var $query ContentQuery */
        $query = Content::find();

        $query->andFilterWhere([
            'in', 'id', $ids
        ]);
        try {
            Content::deleteAll($query->where);
            return $this->controller->showFlash('操作成功', 'success',Yii::$app->user->getReturnUrl());
        }catch(Exception $e){
            return $this->controller->showFlash($e->getMessage(),'danger',Yii::$app->user->getReturnUrl());
        }
    }
}