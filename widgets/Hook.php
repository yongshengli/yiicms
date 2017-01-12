<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/12
 * Time: 11:21
 * Email:liyongsheng@meicai.cn
 */

namespace app\widgets;

use app\models\Config;
use yii\base\ErrorException;
use yii\base\Widget;

/**
 * 用于直接获取配置信息并输出到页面指定位置
 * Class Hook
 * @package app\widgets
 */
class Hook extends Widget
{
    /** @var  config 表中的 name 字段 */
    public $configName;

    /** @var int 缓存有效期 */
    public $duration = 3600;

    /**
     *
     * @return mixed|string
     * @throws ErrorException
     */
    public function run()
    {
        if(empty($this->configName)){
            throw new ErrorException('configName不能为空');
        }
        $config = Config::getDb()->cache(function () {
            return Config::find()->where(['name' => $this->configName])->one();
        }, $this->duration);
        return empty($config)?'':$config['value'];
    }
}