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
        if(!empty($configs)){
            $this->setAttributes($configs, false);
        }
    }
    public function save()
    {
        $phpCode  = "<?php \n return ".var_export($this->_config,true).";\n";
        return file_put_contents(Yii::getAlias('@app/config/params.php'),$phpCode);
    }

    public function load($data, $formName = null)
    {
        $scope = $formName === null ? $this->formName() : $formName;
        if ($scope === '' && !empty($data)) {
            $this->setAttributes($data, false);

            return true;
        } elseif (isset($data[$scope])) {
            $this->setAttributes($data[$scope], false);

            return true;
        } else {
            return false;
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
        return json_encode($this->_config['nav'], JSON_UNESCAPED_UNICODE);
    }

    public function setNav($value)
    {
        if(is_string($value)){
            $value = json_decode($value, true);
        }
        $this->_config['nav'] = $value;
        return;
    }
    public function attributes()
    {
        return array_keys(Yii::$app->params);
    }

    private $_config = [];

    public function __get($name){
        try{
            $value = parent::__get($name);
            return $value;
        }catch (UnknownPropertyException $e){
            if(isset($this->_config[$name])){
                return $this->_config[$name];
            }else {
                throw $e;
            }
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