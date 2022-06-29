<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2022-2099 Jinan Larva Information Technology Co., Ltd.
 */

use Larva\Admin\Models\Administrator;
use Larva\Admin\Models\Menu;
use Larva\Admin\Models\Permission;
use Larva\Admin\Models\Role;

return [
    'name' => 'Admin',
    'title' => 'Admin',
    //登录界面
    'loginLogo' => '',
    'loginDesc' => '站在巨人的肩上 - 超强的自定义后台管理系统',
    //默认头像
    'default_avatar' => 'https://gw.alipayobjects.com/zos/antfincdn/XAosXuNZyF/BiazfanxmamNRoxxVxka.png',
    //版权
    'copyright' => 'Copyright © 2022 LarvaTech',
    //底部菜单
    'footerLinks' => [
        [
            'href' => 'https://www.larva.com.cn',
            'title' => '官网'
        ],

    ],
    'bootstrap' => app_path('Admin/bootstrap.php'),

    'route' => [
        'domain' => null,
        'prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'),
        'namespace' => 'App\\Admin\\Controllers',
        'middleware' => ['web', 'admin'],
    ],
    'directory' => app_path('Admin'),

    'https' => env('ADMIN_HTTPS', false),

    'database' => [
        'users_model' => Administrator::class,
        'roles_model' => Role::class,
        'permissions_model' => Permission::class,
        'menu_model' => Menu::class,
    ],
];