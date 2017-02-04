<?php
namespace app\widgets;

use yii\base\ErrorException;
use app\models\Config;
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/10
 * Time: 14:16
 * Email:liyongsheng@meicai.cn
 */
class ConfigPanel extends Panel
{
    public $configName;

    public function init()
    {
        parent::init();
        if(empty($this->configName)){
            throw new ErrorException('configName 不能为空');
        }
        $config = Config::find()->where(['name'=>$this->configName])->one();
        if($config) {
            $this->title = $config->label;
            $this->body = $config->value;
        }else{
            $this->title = '未知的配置项 "'.$this->configName.'"';
            $this->body = '未知的配置项 "'.$this->configName.'", 请在后台其他配置中添加此配置';
        }
    }
}