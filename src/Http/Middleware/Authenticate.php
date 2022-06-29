<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin\Http\Middleware;

use Closure;
use Larva\Admin\Facades\Admin;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        $redirectTo = admin_base_path(config('admin.auth.redirect_to', 'view/login'));

        if (!$this->shouldPassThrough($request) && Admin::guard()->guest()) {
            return redirect()->guest($redirectTo);
        }
        return $next($request);
    }

    protected function shouldPassThrough($request): bool
    {
        $excepts = config('admin.auth.excepts', [
            'login',
            'view/login',
            'logout',
        ]);

        return collect($excepts)
            ->map('admin_base_path')
            ->contains(function ($except) use ($request) {
                if ($except !== '/') {
                    $except = trim($except, '/');
                }
                return $request->is($except);
            });
    }
}
