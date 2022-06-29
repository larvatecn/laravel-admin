<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;

class Admin
{
    public function bootstrap()
    {
        require config('admin.bootstrap', admin_path('bootstrap.php'));
    }

    public function user()
    {
        return $this->guard()->user();
    }


    public function guard(): Guard|StatefulGuard
    {
        $guard = config('admin.auth.guard') ?: 'admin';
        return Auth::guard($guard);
    }
}
