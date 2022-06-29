<?php

declare(strict_types=1);
/**
 * This is NOT a freeware, use is subject to license terms
 */

namespace Larva\Admin\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Larva\Admin\Facades\Admin;

class Bootstrap
{
    public function handle(Request $request, Closure $next)
    {
        Admin::bootstrap();

        return $next($request);
    }

}