<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2016/12/10
 * Time: 22:48
 * Email:liyongsheng@meicai.cn
 */

namespace app\widgets;

use app\models\Category as CModel;
use app\models\Content;
use yii\base\ErrorException;
use yii\bootstrap\Html;
use yii\helpers\Url;

class Category extends Panel
{
    public $title = '产品分类';
    public $baseUrl;
    public $limit = 5;
    public $type;

    public function renderBodyBegin()
    {
        if($this->showBody==false){
            return null;
        }
        if(empty($this->baseUrl)){
            $this->baseUrl = '/'.Content::type2String($this->type).'/list';
        }
       
        $query= CModel::find();
        $newsList = $query->andWhere(['type'=>$this->type])
            ->limit($this->limit)
            ->orderBy('id asc')
            ->all();
        //echo $query->createCommand()->sql;
        $html = Html::beginTag('ul', ['class'=>'list-group']);
        foreach($newsList as $item) {
            $url = Url::to([$this->baseUrl, 'category-id'=>$item['id']]);
            $html .= '<li class="list-group-item"><a href="'.$url.'">'.$item['name'].'</a></li>';
        }
        $html .= Html::endTag('ul');
        return $html;
    }

    public function run()
    {
        $cacheKey = __CLASS__ . Yii::$app->language . $this->type;
        $html = Yii::$app->cache->get($cacheKey);
        if ($html === false) {
            ob_start();
            echo Html::beginTag('div', $this->options) . "\n";
            echo $this->renderHeader() . "\n";
            echo $this->renderBodyBegin() . "\n";
            echo Html::endTag('div');
            $html = ob_get_clean();
            Yii::$app->cache->set($cacheKey, $html, 600);
        }
        echo $html;
    }}