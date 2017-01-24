<?php
namespace app\widgets;
use yii\bootstrap\Widget;
use yii\bootstrap\Html;
use Yii;

/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/10
 * Time: 14:33
 * Email:liyongsheng@meicai.cn
 */
class Panel extends Widget
{
    public $options =['class'=>'panel panel-default'];
    public $showHeader = true;
    public $showBody = true;
    public $title ='';
    public $body = '';

    public function renderHeader()
    {
        if($this->showHeader==false){
            return null;
        }
        $html = Html::beginTag('div', ['class'=>'panel-heading']);
        $html .= Html::beginTag('h3', ['class'=>'panel-title']);
        $html .= Yii::t('app', $this->title);
        $html .= Html::endTag('h3');
        $html .= Html::endTag('div');
        return $html;
    }

    public function renderBodyBegin()
    {
        if($this->showBody==false){
            return null;
        }
        $html = Html::beginTag('div', ['class'=>'panel-body']);
        $html .= $this->body;
        $html .= Html::endTag('div');
        return $html;
    }

    public function run()
    {
        echo Html::beginTag('div', $this->options) . "\n";
        echo $this->renderHeader() . "\n";
        echo $this->renderBodyBegin() . "\n";
        echo Html::endTag('div');
    }
}