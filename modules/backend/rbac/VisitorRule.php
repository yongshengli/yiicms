<?php
namespace app\modules\backend\rbac;

use yii\rbac\Item;
use Yii;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/28
 * Time: 12:08
 * Email:liyongsheng@meicai.cn
 */
class VisitorRule extends \yii\rbac\Rule
{

    public $name = 'VisitorRule';
    /**
     * Executes the rule.
     *
     * @param string|integer $user the user ID. This should be either an integer or a string representing
     * the unique identifier of a user. See [[\yii\web\User::id]].
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to [[CheckAccessInterface::checkAccess()]].
     * @return boolean a value indicating whether the rule permits the auth item it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if(Yii::$app->request->isGet){
            return true;
        }else{
            if(Yii::$app->request->isPost && Yii::$app->controller->action->id=='logout'){
                return true;
            }
            return false;
        }
    }
}