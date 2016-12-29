<?php
use app\models\Content;
use app\helpers\StringHelper;
?>
<aside class="main-sidebar">

    <section class="sidebar">
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id,null,function($menu){
                    $data = empty($menu['data'])?[]:json_decode($menu['data'], true);
                    $icon ='';
                    if(isset($data['icon'])){
                        $icon = $data['icon'];
                        unset($data['icon']);
                    }
                    return [
                        'icon' => $icon,
                        'label' => $menu['name'],
                        'url' => [$menu['route']],
                        'options' => $data,
                        'items' => $menu['children']
                    ];
                })
            ]
        ) ?>

    </section>

</aside>
