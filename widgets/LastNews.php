<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/10
 * Time: 15:03
 * Email:liyongsheng@meicai.cn
 */

namespace app\widgets;
use app\models\News;
use yii\bootstrap\Html;
use yii\helpers\Url;

class LastNews extends Panel
{
    public $title = '最新新闻';
    public $limit=5;
    public $showDate = false;
    public function renderBodyBegin()
    {
        if($this->showBody==false){
            return null;
        }
        $newsList = News::find()
            ->where(['status'=>News::STATUS_ENABLE])
            ->limit($this->limit)
            ->orderBy('id desc')
            ->all();
        $html = Html::beginTag('ul', ['class'=>'list-group']);
        foreach($newsList as $item) {
            $url = Url::to(['/news/', 'id'=>$item['id']]);
            $html .= '<li class="list-group-item"><a href="'.$url.'">'.$item['title'].'</a>';
            if($this->showDate){
                $html .= '<span class="badge">'.date('Y-m-d').'</span>';
            }
            $html .= '</li>';
        }
        $html .= Html::endTag('ul');
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