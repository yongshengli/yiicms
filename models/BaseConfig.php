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

class BaseConfig extends Model
{
    /**
     * @var string 网站名称
     */
    public $appName;

    public $logo;
    public $keywords;
    public $description;
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
            $this->setAttributes($configs, false);
        }
    }
    public function save()
    {
        $phpCode  = "<?php \n return ".var_export($this->getAttributes(),true).";\n";
        return file_put_contents(Yii::getAlias('@app/config/params.php'),$phpCode);
    }
    public function rules()
    {
        return [
            [['appName', 'logo', 'pageSize', 'nav'], 'required'],
            [['appName'], 'string', 'max' => 100],
            [['keywords'], 'string', 'max' => 300],
            [['description'], 'string', 'max' => 500],
        ];
    }
    /**
     * 属性label
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'appName'=>'网站名称',
            'keywords'=>'网站关键字',
            'description'=>'网站描述',
            'adminEmail'=>'管理员邮箱',
            'pageSize'=>'每页显示元素数',
            'logo'=>'网站logo路径',
            'nav'=>'导航内容',
        ];
    }
    public function attributes()
    {
        return array_keys(Yii::$app->params);
    }
}