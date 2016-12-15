<?php
/**
 * 后台左侧菜单.
 * User: King
 * Date: 2016/12/15
 * Time: 15:18
 */

use mdm\admin\components\MenuHelper;

$callback = function ($menu) {
    $data = json_decode($menu['data'], true);
    $items = $menu['children'];
    $return = [
        'label' => $menu['name'],
        'url'   => [$menu['route']],
    ];
    //处理我们的配置
    if ($data) {
        //visible
        isset($data['visible']) && $return['visible'] = $data['visible'];
        //icon
        isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
        //other attribute e.g. class...
        $return['options'] = $data;
    }
    //没配置图标的显示默认图标
    (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-circle-o';
    $items && $return['items'] = $items;

    return $return;
};
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/statics/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?=
            backend\widgets\Menu::widget([
                'options' => ['class' => 'sidebar-menu'],
                'items'   => MenuHelper::getAssignedMenu(Yii::$app->user->id, null, $callback),
            ]);
            ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>