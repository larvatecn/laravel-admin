<?php

declare(strict_types=1);
/**
 * This is NOT a freeware, use is subject to license terms
 */

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