<?php

namespace app\modules\backend\components;
use yii\web\Controller;
use Yii;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/7
 * Time: 15:11
 * Email:liyongsheng@meicai.cn
 */
class BackendController extends Controller
{

    /**
     * 设置页面提示信息
     * @param string $message
     * @param string $type
     * @param array|string $url
     * @return \yii\web\Response the current response object
     */
    public function showFlash($message, $type='danger', $url=null)
    {
        $this->addFlash($message, $type, true);

        if($url==null){
            return $this->refresh();
        }
        return $this->redirect($url);
    }

    /**
     * 添加页面提示信息
     * @param string|array $message
     * @param string $type
     * @param bool $removeAfterAccess
     */
    public function addFlash($message, $type='danger',$removeAfterAccess=true)
    {
        Yii::$app->session->addFlash($type, $message, $removeAfterAccess);
    }

    public function refresh($anchor = '')
    {
        return Yii::$app->getResponse()->redirect(Url::current() . $anchor);
    }

    public function goBack($defaultUrl = null){
        return parent::goBack($this->getReturnUrl($defaultUrl));
    }

    public function getReturnUrl($defaultUrl = null){
        return sprintf('/%s%s', \yii::$app->language,Yii::$app->getUser()->getReturnUrl($defaultUrl));
    }
}