<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/2/8
 * Time: 13:38
 * Email:liyongsheng@meicai.cn
 */

namespace app\widgets;

use app\models\Blogroll as Model;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

class Blogroll extends Menu
{
    /**
     * 友情链接分类id
     * @var int
     */
    public $categoryId = 0;

    /**
     * 条数限制
     * @var int
     */
    public $limit = 0;

    /**
     * 使用 图片时
     * '<a href="{url}" title="{label}"><img src="{image}" alt="{label}"/></a>'
     * @var string
     */
    public $linkTemplate = '<a href="{url}">{label}</a>';
    /**
     * @var boolean whether to automatically activate items according to whether their route setting
     * matches the currently requested route.
     * @see isItemActive()
     */
    public $activateItems = false;


    public function init()
    {
        parent::init();
        $query = Model::find();
        if($this->categoryId) {
            $query->where(['category_id'=>$this->categoryId]);
        }
        if($this->limit){
            $query->limit($this->limit);
        }
        $list = $query->asArray()->all();
        $items = [];
        foreach($list as &$row){
            $items[] =[
                'label'=>$row['title'],
                'image'=>$row['image'],
                'url'=>$row['link'],
            ];
        }
        $this->items = &$items;
    }
    /**
     * Renders the content of a menu item.
     * Note that the container and the sub-menus are not rendered here.
     * @param array $item the menu item to be rendered. Please refer to [[items]] to see what data might be in the item.
     * @return string the rendering result
     */
    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);

            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => $item['label'],
                '{image}' => $item['image'],
            ]);
        } else {
            $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

            return strtr($template, [
                '{label}' => $item['label'],
                '{image}' => $item['image'],
            ]);
        }
    }
}