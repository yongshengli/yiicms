<?php

namespace app\modules\backend\components;
use yii\web\Controller;
use yii\filters\AccessControl;
use Yii;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/7
 * Time: 15:11
 * Email:liyongsheng@meicai.cn
 */
class BackendController extends Controller
{
    public function init()
    {
        parent::init();
        $this->initShowMessage();
    }
    /**
     * 初始化页面提示信息
     */
    protected function initShowMessage()
    {
        $showMessage = Yii::$app->session->get('showMessage');
        if($showMessage) {
            $this->view->params['showMessage'] = $showMessage;
            Yii::$app->session->remove('showMessage');
        }
    }

    /**
     * 设置页面提示信息
     * @param string $message
     * @param string $type
     * @param array|string $url
     * @return \yii\web\Response the current response object
     */
    protected function showMessage($message, $type='danger', $url=null)
    {
        Yii::$app->session->set('showMessage', [
            'type'=>$type,
            'message'=>$message
        ]);
        if($url==null){
            return $this->refresh();
        }
        return $this->redirect($url);
    }
}