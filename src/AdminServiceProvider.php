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
    protected array $commands = [
        Console\InstallCommand::class,
    ];

    /**
     * 路由中间件
     *
     * @var array|string[]
     */
    protected array $routeMiddleware = [

    ];

    /**
     * 中间件组
     *
     * @var array|array[]
     */
    protected array $middlewareGroups = [
        'admin' => [

        ],
    ];

    /**
     * 启动执行
     */
    public function boot(): void
    {

    }

    /**
     * 注册服务
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'admin');
    }

    public function provides(): array
    {
        return ['admin'];
    }


    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/admin.php' => config_path('admin.php'),
        ], 'admin.config');

        // Publishing assets.
        $this->publishes([
            __DIR__ . '/../resources/dist' => public_path('vendor/admin'),
        ], 'admin.assets');

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
