<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/30
 * Time: 10:21
 * Email:liyongsheng@meicai.cn
 */

namespace app\modules\backend\models;

use yii\helpers\FileHelper;
use yii\base\Model;
use Yii;

class ViewConfig extends Model
{
    /**
     * 主题路径
     * @var string
     */
    public $themePath ='@app/views';

    /** @var string  主题颜色 */
    public $themeColor = 'blue';

    /**
     * 初始化model
     */
    public function init(){
        parent::init();
        if(!empty(Yii::$app->components['view'])){
            $configs = Yii::$app->components['view'];
            isset($configs['params']['themeColor']) && $this->themeColor = $configs['params']['themeColor'];
            isset($configs['theme']['pathMap']['@app/views']) && $this->themePath = $configs['theme']['pathMap']['@app/views'];
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
        if(!is_dir(Yii::getAlias('@runtime/config/'))){
            FileHelper::createDirectory(Yii::getAlias('@runtime/config/'));
        }
        $phpCode = "<?php \n //please do not modify this file, this file is built by app\\modules\\backend\\models\\baseConfig.php ";
        $phpCode .= "\n return " . var_export($this->_createConfig(), true) . ";\n";
        $res = file_put_contents(Yii::getAlias('@runtime/config/view.php'), $phpCode);
        $assetsDir = Yii::getAlias('@app/web/assets');
        foreach(scandir($assetsDir) as $item) {
            if($item=='.' || $item=='..') {
                continue;
            }
            FileHelper::removeDirectory($assetsDir . '/'.$item);
        }
//        FileHelper::createDirectory($assetsDir, 0777);
        return $res;
    }

    /**
     * 组织view配置数组
     * @return array
     */
    private function _createConfig()
    {
        if($this->themePath =='@app/views'){
            return [
                'params'=>[
                    'themeColor' => $this->themeColor
                ],
            ];
        }
        return [
            'theme' => [
                'pathMap' => [
                    '@app/views' => $this->themePath
                ],
            ],
            'params'=>[
                'themeColor' => $this->themeColor
            ],
        ];
    }

    /**
     * 获取全部主题
     * @return array
     */
    public function getThemes()
    {
        $themePathAlias = '@app/themes';
        $themePath = Yii::getAlias($themePathAlias);
        $themeDirList = scandir($themePath);

        $themeList = [
            '@app/views'=>'默认风格'
        ];
        foreach($themeDirList as $dir){
            if($dir =='.' || $dir=='..' || !is_dir($themePath.'/'.$dir) || $dir=='.git'){
                continue;
            }
            if(!file_exists($themePath.'/'.$dir.'/Theme.php')){
                continue;
            };
            $themeName = $dir;
            $themeClass = '\\app\\themes\\'.$dir.'\\Theme';
            if(class_exists($themeClass) && method_exists($themeClass, 'themeName')){
                $themeName = call_user_func([$themeClass, 'themeName']);
            }
            $alias = $themePathAlias.'/'.$dir;
            $themeList[$alias] = $themeName;
        }
        return $themeList;
    }
    public function getThemeColors()
    {
        return [
            'blue'=>'蓝色',
            'red'=>'红色',
            'yellow'=>'黄色',
            'green'=>'绿色',
            'purple'=>'紫色',
        ];
    }

    public function rules()
    {
        return [
            [['themePath','themeColor'], 'required'],
            ['themeColor', 'string', 'max' => 20],
        ];
    }
    /**
     * 属性label
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'themeColor'=>'主题颜色',
            'themePath'=>'主题',
        ];
    }
}