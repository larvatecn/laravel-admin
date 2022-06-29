<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * 控制台命令
     *
     * @var array|string[]
     */
    protected array $commands = [
        Console\InstallCommand::class,
    ];

    /**
     * 路由中间件
     *
     * @var array|string[]
     */
    protected array $routeMiddleware = [
        'admin.auth' => Http\Middleware\Authenticate::class,
        'admin.bootstrap' => Http\Middleware\Bootstrap::class,
        'admin.session' => Http\Middleware\Session::class,
        'admin.permission' => Http\Middleware\Permission::class,
    ];

    /**
     * 中间件组
     *
     * @var array|array[]
     */
    protected array $middlewareGroups = [
        'admin' => [
            'admin.auth',
            'admin.bootstrap',
            'admin.session',
            'admin.permission',
        ],
    ];

    /**
     * 启动执行
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        if (file_exists($routes = admin_path('routes.php'))) {
            $this->loadRoutesFrom($routes);
        }
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * 注册服务
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'admin');//合并配置
        $this->loadAdminAuthConfig();
        $this->registerRouteMiddleware();

        // Register the service the package provides.
        $this->app->singleton('admin', function () {
            return new Admin();
        });
    }

    public function provides(): array
    {
        return ['admin'];
    }

    /**
     * 控制台启动
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/admin.php' => config_path('admin.php'),
        ], 'admin-config');

        // Publishing assets.
        $this->publishes([
            __DIR__ . '/../resources/dist' => public_path('vendor/admin'),
        ], 'admin-assets');

        // Registering package commands.
        $this->commands($this->commands);
    }

    /**
     * 加载认证配置
     */
    protected function loadAdminAuthConfig(): void
    {
        config(Arr::dot(config('admin.auth', []), 'auth.'));
    }

    /**
     * 注册路由中间件
     */
    protected function registerRouteMiddleware(): void
    {
        $router = $this->app->make('router');
        foreach ($this->routeMiddleware as $key => $middleware) {
            $router->aliasMiddleware($key, $middleware);
        }
        foreach ($this->middlewareGroups as $key => $middleware) {
            $router->middlewareGroup($key, $middleware);
        }
    }
}
