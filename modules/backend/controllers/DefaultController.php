<?php

namespace app\modules\backend\controllers;
use app\modules\backend\components\BackendController;
use app\modules\backend\models\ContentCount;
use app\modules\backend\models\AdminUser;
use app\modules\backend\models\EditPasswordForm;
use Yii;
use app\modules\backend\models\LoginForm;
use yii\filters\VerbFilter;
use app\helpers\StringHelper;
use yii\helpers\FileHelper;

/**
 * Default controller for the `backend` module
 */
class DefaultController extends BackendController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'ueditor' => $this->module->components['UEditorAction']
        ];
    }
    /**
     * 后台首页
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'contentCountList'=>ContentCount::getCountGroupByType()
        ]);
    }

    /**
     * 登录页面
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'main-login.php';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['/backend/default/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/backend/default/login']);
    }
    /**
     * @return string
     */
    public function actionEditPassword()
    {
        $model = new EditPasswordForm();
        $model->user = AdminUser::findOne(Yii::$app->user->id);
        if(empty($model->user) || !($model->user instanceof AdminUser)){
            $this->addFlash('用户不存在或者已删除');
        }
        if($model->load(Yii::$app->request->post()) && $model->saveEdit()){
            return $this->showFlash('修改成功', 'success');
        }
//        print_r($model->errors);
        return $this->render('edit-password',[
            'model'=>$model
        ]);
    }

    /**
     * 清理缓存
     * @return \yii\web\Response
     * @throws \yii\base\ErrorException
     */
    public function actionClearCache()
    {
        if(defined("ASSETS_DIR")) {
            $list = scandir(ASSETS_DIR);
            foreach($list as $dir){
                if($dir=='.' || $dir=='..'){
                    continue;
                }
                FileHelper::removeDirectory(ASSETS_DIR.'/'.$dir);
            }
        }
        if(Yii::$app->cache->flush()==true){
            $this->addFlash('缓存清理成功', 'info');
        }else {
            $this->addFlash('缓存清理失败');
        }
        return $this->goBack();
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
}
