<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 2017/1/24
 * Time: 13:45
 * Email:liyongsheng@meicai.cn
 */

namespace app\helpers;
use Yii;

class CommonHelper
{
    /**
     * 递归翻译导航内容
     * @param array $nav
     * @param string $category
     * @return mixed
     */
    static public function navTranslation($nav, $category='app')
    {
        $nav['items'] = self::navItemsTranslation($nav['items'], $category);
        return $nav;
    }

    /**
     * 递归翻译导航内容
     * @param array $navItems
     * @param string $category
     * @return mixed
     */
    static public function navItemsTranslation($navItems, $category='app')
    {
        foreach($navItems as &$item){
            if(isset($item['items']) && is_array($item['items'])){
                $item['items']= self::navItemsTranslation($item['items']);
            }
            $item['label'] = Yii::t($category, $item['label']);
        }
        return $navItems;
    }
}