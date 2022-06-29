<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Http\Controllers;

class MainController extends AdminController
{
    public function index()
    {
        $config = [
            'name' => config('admin.name'),
            'title' => config('admin.title'),
            'apiBase' => admin_url(config('admin.route.prefix')),
            'prefix' => config('admin.route.prefix'),
            'loginLogo' => config('admin.loginLogo'),
            'loginDesc' => config('admin.loginDesc'),
            'copyright' => config('admin.copyright'),
            'footerLinks' => config('admin.footerLinks'),
        ];

        return view('admin::main', ['config' => $config]);
    }
}
