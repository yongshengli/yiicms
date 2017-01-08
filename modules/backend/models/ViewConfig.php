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
    public $themePath ='@app/views/default';

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
        return file_put_contents(Yii::getAlias('@runtime/config/view.php'), $phpCode);
    }

    private function _createConfig()
    {
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
    public function getThemes()
    {
        return [
            '@app/views/tradition'=>'传统企业站风格',
            '@app/views/default'=>'bootStrap风格',
        ];
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