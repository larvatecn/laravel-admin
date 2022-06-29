<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2022-2099 Jinan Larva Information Technology Co., Ltd.
 */

use Larva\Admin\Models\AdminUser;
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
        'connection' => '',
        'users_table' => 'admin_users',
        'users_model' => AdminUser::class,
        'roles_table' => 'admin_roles',
        'roles_model' => Role::class,
        'permissions_table' => 'admin_permissions',
        'permissions_model' => Permission::class,
        'menu_table' => 'admin_menu',
        'menu_model' => Menu::class,

        'user_permissions_table' => 'admin_user_permissions',
        'role_users_table' => 'admin_role_users',
        'permission_menu_table' => 'admin_permission_menu',
        'role_permissions_table' => 'admin_role_permissions',
        'role_menu_table' => 'admin_role_menu',
        'settings_table' => 'admin_settings',
    ],
];