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