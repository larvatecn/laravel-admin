<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Larva\Admin\Http\Controllers\SystemSettingsController;
use Larva\Admin\Http\Controllers\AdministratorController;
use Larva\Admin\Http\Controllers\AuthController;
use Larva\Admin\Http\Controllers\HandleController;
use Larva\Admin\Http\Controllers\MainController;
use Larva\Admin\Http\Controllers\MenuController;
use Larva\Admin\Http\Controllers\PermissionController;
use Larva\Admin\Http\Controllers\RoleController;
use Larva\Admin\Http\Controllers\SettingsController;

Route::group([
    'domain' => config('admin.route.domain'),
    'prefix' => config('admin.route.prefix', 'admin'),
    'middleware' => config('admin.route.middleware'),
], static function (Router $router) {
    $router->get('/', [MainController::class, 'index']);
    $router->get('view', [MainController::class, 'index']);
    $router->get('view/{name}', [MainController::class, 'index'])->where('name', '.*');
    $router->get('getMenu', [HandleController::class, 'menu'])->name('admin.getMenu');
    $router->get('getHeaderToolbar', [HandleController::class, 'headerToolbar'])->name('admin.headerToolbar');
    $router->any('_handle_action_', [HandleController::class, 'action'])->name('admin.handle-action');
    $router->post('_handle_upload_image_', [HandleController::class, 'uploadImage'])->name('admin.handle-upload-image');
    $router->post('_handle_upload_file_', [HandleController::class, 'uploadFile'])->name('admin.handle-upload-file');

    $authController = config('admin.auth.controller', AuthController::class);

    $router->resource('login', $authController)->names('admin.login')->only(['index', 'store']);
    $router->get('logout', [$authController, 'logout'])->name('admin.logout');
    $router->any('user_setting', [$authController, 'userSetting'])->name('admin.userSetting');

    $router->resource('admin_users', AdministratorController::class)->names('admin.user');
    $router->resource('menus', MenuController::class)->names('admin.menu');
    $router->resource('roles', RoleController::class)->names('admin.role');
    $router->resource('permissions', PermissionController::class)->names('admin.permission');
    $router->get('permissions_auto_generate', [PermissionController::class, 'autoGenerate'])->name('admin.permission.auto-generate');
    $router->resource('settings', SettingsController::class)->names('admin.settings');
    $router->get('system_setting', [SystemSettingsController::class, 'index'])->name('admin.system_setting');
    $router->post('system_setting', [SystemSettingsController::class, 'save'])->name('admin.system_setting.save');
});
