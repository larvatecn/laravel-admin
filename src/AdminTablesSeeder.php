<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin;

use Illuminate\Database\Seeder;
use Larva\Admin\Models\Administrator;
use Larva\Admin\Models\Menu;
use Larva\Admin\Models\Permission;
use Larva\Admin\Models\Role;
use Larva\Settings\SettingEloquent;

class AdminTablesSeeder extends Seeder
{
    public function run()
    {
        //初始化配置
        collect([
            //默认配置
            ['name' => 'Web Url', 'key' => 'system.web_url', 'value' => 'https://www.larva.com.cn', 'cast_type' => 'string'],
            ['name' => '移动 Url', 'key' => 'system.wap_url', 'value' => 'https://www.larva.com.cn', 'cast_type' => 'string'],
            ['name' => '网站标题', 'key' => 'system.title', 'value' => 'Larva CMS', 'cast_type' => 'string'],
            ['name' => '网站关键词', 'key' => 'system.keywords', 'value' => '网站关键词', 'cast_type' => 'string'],
            ['name' => '网站描述', 'key' => 'system.description', 'value' => '网站描述', 'cast_type' => 'string'],
            ['name' => 'ICP备案', 'key' => 'system.icp_record', 'value' => '鲁ICP备19007076号-8', 'cast_type' => 'string'],
            ['name' => '公安备案', 'key' => 'system.police_record', 'value' => '', 'cast_type' => 'string'],
            ['name' => '服务邮箱', 'key' => 'system.support_email', 'value' => 'support@larva.com.cn', 'cast_type' => 'string'],
            ['name' => '法律邮箱', 'key' => 'system.lawyer_email', 'value' => 'lawyer@larva.com.cn', 'cast_type' => 'string'],

            //上传配置
            ['name' => '上传自动重命名', 'key' => 'uploader.unique_name', 'value' => '1', 'cast_type' => 'bool'],//启用唯一命名
            ['name' => '图片上传后缀', 'key' => 'uploader.image_mimes', 'value' => 'jpeg,bmp,png,gif,jpg', 'cast_type' => 'string'],//允许上传的图片文件后缀
            ['name' => '文件上传后缀', 'key' => 'uploader.file_mimes', 'value' => 'gz,zip,rar,doc,txt,md,pdf,ppt,pptx,doc,docx,xls,xlsx,csv', 'cast_type' => 'string'],//允许上传的文件后缀
        ])->each(fn($item) => SettingEloquent::create($item));

        Administrator::truncate();
        Administrator::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'name' => '超级管理员',
        ]);
        Role::truncate();
        Role::create([
            'name' => '超级管理员',
            'slug' => 'administrator',
        ]);
        Administrator::first()->roles()->save(Role::first());

        Permission::truncate();
        collect([
            [
                'name' => '首页',
                'slug' => 'home',
                'http_method' => ['GET'],
                'http_path' => ['/home*'],
                'order' => 1,
                'parent_id' => 0,
            ],
            [
                'name' => '系统',
                'slug' => 'sys-manage',
                'order' => 2,
                'parent_id' => 0,
            ],
            [
                'name' => '权限管理',
                'slug' => 'permissions',
                'http_path' => ['/permissions*'],
                'order' => 3,
                'parent_id' => 2,
            ],
            [
                'name' => '菜单管理',
                'slug' => 'menus',
                'http_path' => ['/menus*'],
                'order' => 4,
                'parent_id' => 2,
            ],
            [
                'name' => '角色管理',
                'slug' => 'roles',
                'http_path' => ['/roles*'],
                'order' => 5,
                'parent_id' => 2,
            ],
            [
                'name' => '后台用户管理',
                'slug' => 'admin_users',
                'http_path' => ['/admin_users*'],
                'order' => 6,
                'parent_id' => 2,
            ],
            [
                'name' => '配置管理',
                'slug' => 'settings',
                'http_path' => ['/settings*'],
                'order' => 7,
                'parent_id' => 2,
            ],
            [
                'name' => '系统配置',
                'slug' => 'system_setting',
                'http_path' => ['/system_setting*'],
                'order' => 8,
                'parent_id' => 2,
            ],
        ])->each(fn($item) => Permission::create($item));

        Role::first()->permissions()->save(Permission::first());
        Menu::truncate();
        Menu::insert([
            [
                'parent_id' => 0,
                'order' => 1,
                'title' => '仪表盘',
                'icon' => 'fa-solid fa-desktop',
                'uri' => 'home',
                'key' => 'home',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => '系统管理',
                'icon' => 'fa-solid fa-screwdriver-wrench',
                'uri' => '',
                'key' => 'sys',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => '管理员管理',
                'icon' => '',
                'uri' => 'admin_users',
                'key' => 'admin_users',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => '角色管理',
                'icon' => '',
                'uri' => 'roles',
                'key' => 'roles',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => '权限管理',
                'icon' => '',
                'uri' => 'permissions',
                'key' => 'permissions',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => '菜单管理',
                'icon' => '',
                'uri' => 'menus',
                'key' => 'menus',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 7,
                'title' => '配置管理',
                'icon' => '',
                'uri' => 'settings',
                'key' => 'settings',
                'uri_type' => 'route',
            ],
            [
                'parent_id' => 2,
                'order' => 8,
                'title' => '系统配置',
                'icon' => '',
                'uri' => 'system_setting',
                'key' => 'system_setting',
                'uri_type' => 'route',
            ]
        ]);

    }
}
