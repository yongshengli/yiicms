<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/15
 * Time: 17:39
 * Email:liyongsheng@meicai.cn
 */

namespace app\models;


use yii\base\Model;
use Yii;
use yii\base\UnknownPropertyException;

class BaseConfig extends Model
{
    private $nav;
    /**
     * 初始化model
     */
    public function init(){
        $configs = Yii::$app->params;
//        print_r($configs);
        if(!empty($configs)){
            $this->setAttributes($configs, false);
        }
    }

    /**
     * 属性label
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'appName'=>'网站名称',
            'adminEmail'=>'管理员邮箱',
            'pageSize'=>'每页显示元素数',
            'logo'=>'网站logo路径',
            'nav'=>'导航内容',
        ];
    }
    public function getNav()
    {
        return print_r($this->_config['nav'],true);
    }

    public function setNav($value)
    {
        if(is_string($value)){
            $value = var_export($value, true);
        }
        $this->_config['nav'] = $value;
    }
    public function attributes()
    {
        return array_keys(Yii::$app->params);
    }

    private $_config = [];

    public function __get($name){
        try{
            parent::__get($name);
        }catch (UnknownPropertyException $e){
            if(isset($this->_config[$name])){
                return $this->_config[$name];
            }
            throw $e;
        }
    }

    public function __set($name, $value){
        try {
            parent::__set($name, $value);
        }catch(UnknownPropertyException $e){
            $this->_config[$name] = $value;
        }
    }
}