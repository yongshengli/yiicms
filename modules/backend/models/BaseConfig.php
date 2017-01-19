<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/15
 * Time: 17:39
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\models;


use yii\base\Model;
use Yii;
use yii\helpers\FileHelper;

class BaseConfig extends Model
{
    /**
     * @var string 网站名称
     */
    public $appName;
    /**
     * @var string 首页标题
     */
    public $homeTitle ='';

    public $logo;
    public $keywords;
    public $description;

    /** @var int 页面缓存时长 秒 */
    public $cacheDuration = 60;

    /** @var int 每页显示元素个数 */
    public $pageSize =20;
    /**
     * @var string json 导航
     */
    public $nav;

    /**
     * 初始化model
     */
    public function init(){
        $configs = Yii::$app->params;
        if(!empty($configs)){
            $this->setAttributes($configs);
        }
    }

    /**
     * 保存数据
     * @param bool $runValidation
     * @return bool|int
     */
    public function save($runValidation = true)
    {
        if($runValidation && !$this->validate()) {
            Yii::info('Model not updated due to validation error.', __METHOD__);
            return false;
        }
        $phpCode = "<?php \n //please do not modify this file, this file is built by app\\modules\\backend\\models\\baseConfig.php ";
        $phpCode .= "\n return " . var_export($this->toArray(), true) . ";\n";
        if(!is_dir(Yii::getAlias('@runtime/config/'))){
            FileHelper::createDirectory(Yii::getAlias('@runtime/config/'));
        }
        return file_put_contents(Yii::getAlias('@runtime/config/params.php'), $phpCode);
    }

    public function rules()
    {
        return [
            [['appName', 'pageSize', 'nav', 'homeTitle'], 'required'],
            [['appName','homeTitle'], 'string', 'max' => 100],
            [['keywords'], 'string', 'max' => 300],
            [['cacheDuration'], 'integer'],
            ['nav', 'validateJson'],
            [['description','logo'], 'string', 'max' => 500],
        ];
    }

    /**
     * 验证是否是有效的json
     * @param string $attribute
     * @param array $params
     */
    public function validateJson($attribute, $params)
    {
        if(!json_decode($this->nav)){
            $this->addError($attribute, "不是有效的Json字符串");
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
            'homeTitle'=>'首页标题',
            'keywords'=>'网站关键字',
            'description'=>'网站描述',
            'adminEmail'=>'管理员邮箱',
            'pageSize'=>'每页显示元素数',
            'cacheDuration'=>'页面缓存时长',
            'logo'=>'网站logo路径',
            'nav'=>'导航内容',
        ];
    }
}