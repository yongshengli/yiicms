<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/28
 * Time: 10:07
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\components;

use yii\web\Response;
use yii\web\User;
use yii\web\ForbiddenHttpException;
use Yii;

class AccessControl extends \mdm\admin\components\AccessControl
{
    /**
     * Denies the access of the user.
     * The default implementation will redirect the user to the login page if he is a guest;
     * if the user is already logged, will show 403 message
     * @param  User $user the current user
     * @throws ForbiddenHttpException if the user is already logged in.
     */
    protected function denyAccess($user)
    {
        try{
            parent::denyAccess($user);
        }catch(ForbiddenHttpException $e){
            if(Yii::$app->request->isAjax){
                throw $e;
            }else {
                Yii::$app->session->addFlash('danger', $e->getMessage());
                Yii::$app->getResponse()->redirect(Yii::$app->getUser()->getReturnUrl());
                Yii::$app->response->send();
            }
        }
    }
}