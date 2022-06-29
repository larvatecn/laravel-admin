<?php

declare(strict_types=1);
/**
 * This is NOT a freeware, use is subject to license terms
 */

namespace Larva\Admin\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use InvalidArgumentException;
use Larva\Admin\Facades\Admin;
use Larva\Admin\Models\Permission as Checker;
use Larva\Admin\Renderers\Alert;

class Permission
{
    protected string $middlewarePrefix = 'admin.permission:';

    public function handle(Request $request, Closure $next, ...$args)
    {
        if (config('admin.check_route_permission') === false) {
            return $next($request);
        }
        if (
            !empty($args)
            || !config('admin.permission.enable')
            || $this->shouldPassThrough($request)
            || $this->checkRoutePermission($request)
            || Admin::user()?->isAdministrator()
        ) {
            return $next($request);
        }

        if (!Admin::user()?->allPermissions()->first(function (Checker $permission) use ($request) {
            return $permission->shouldPassThrough($request);
        })) {
            if ($request->isMethod('get')) {
                return Admin::response(Alert::make()->body("您没有权限访问该页面")->level("danger")->showIcon(true)->showCloseButton(false));
            }
            return Admin::responseError("没有权限");
        }

        return $next($request);
    }

    public function checkRoutePermission(Request $request): bool
    {
        if (!$middleware = collect($request->route()?->middleware())->first(function ($middleware) {
            return Str::startsWith($middleware, $this->middlewarePrefix);
        })) {
            return false;
        }

        $args = explode(',', str_replace($this->middlewarePrefix, '', $middleware));

        $method = array_shift($args);

        if (!method_exists(Checker::class, $method)) {
            throw new InvalidArgumentException("Invalid permission method [$method].");
        }

        call_user_func([Checker::class, $method], $args);

        return true;
    }

    protected function shouldPassThrough($request): bool
    {
        $excepts = config('admin.permission.excepts', []);

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
