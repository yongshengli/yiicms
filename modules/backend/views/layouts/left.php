<?php
use yii\helpers\Json;
use mdm\admin\components\MenuHelper;
use yii\web\UrlManager;

/**
 * @var \yii\web\View $this
 */
$menuItems = MenuHelper::getAssignedMenu(Yii::$app->user->id,null,function($menu){
    $data = empty($menu['data'])?[]:json_decode($menu['data'], true);
    $icon ='circle-o';
    if(isset($data['icon'])){
        $iconArr = explode(" ", $data['icon']);
        if (count($iconArr)>1){
            $icon = ltrim($iconArr[1], "fa-");
        }else {
            $icon = $data['icon'];
        }
    }
    $route = parse_url($menu['route']);
    $url = [];
    if(isset($route['query'])) {
        parse_str($route['query'], $url);
    }
    array_unshift($url, $route['path']);
    return [
        'icon' => $icon,
        'label' => $menu['name'],
        'url' => $url,
        'options' => $data,
        'items' => $menu['children']
    ];
});
?>
<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" id="menu-keyword" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='button' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $menuItems
            ]
        ) ?>
    </section>
</aside>
