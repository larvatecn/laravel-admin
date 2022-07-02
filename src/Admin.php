<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Larva\Admin\Models\Menu;

class Admin
{
    public static array $css = [];
    public static array $js = [];
    public static array $baseJs = [];

    public static function css($css = null)
    {
        if (!is_null($css)) {
            return self::$css = array_merge(self::$css, (array)$css);
        }
        $css = array_merge(static::$css, []);
        $css = array_filter(array_unique($css));
        return view('admin::partials.css', compact('css'));
    }

    public static function js($js = null)
    {
        if (!is_null($js)) {
            return self::$js = array_merge(self::$js, (array)$js);
        }
        $js = array_merge(static::$js, []);
        $js = array_filter(array_unique($js));
        return view('admin::partials.js', compact('js'));
    }

    public static function baseJs($baseJs = null)
    {
        if (!is_null($baseJs)) {
            return self::$baseJs = array_merge(self::$baseJs, (array)$baseJs);
        }
        $baseJs = array_merge(static::$baseJs, []);
        $baseJs = array_filter(array_unique($baseJs));
        return view('admin::partials.baseJs', compact('baseJs'));
    }

    /**
     * 响应
     *
     * @param $data
     * @param string $message
     * @param int $code
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, string $message = '', int $code = 0, array $headers = []): JsonResponse
    {
        $re_data = [
            'status' => $code,
            'msg' => $message,
        ];
        if ($data) {
            $re_data['data'] = $data;
        }
        return Response::json($re_data, 200, $headers);
    }

    /**
     * 资源响应
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function responseMessage(string $message = '', int $code = 0): JsonResponse
    {
        return $this->response([], $message, $code);
    }

    /**
     * 响应错误
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function responseError(string $message = '', int $code = 1): JsonResponse
    {
        return $this->response([], $message, $code);
    }

    /**
     * 验证数据
     * @param array $all
     * @param array $rules
     * @param array $message
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validatorData(array $all, array $rules, array $message = []): \Illuminate\Contracts\Validation\Validator
    {
        $validator = Validator::make($all, $rules, $message);
        if ($validator->fails()) {
            abort(400, $validator->errors()->first());
        }
        return $validator;
    }

    /**
     * 启动引导
     * @return void
     */
    public function bootstrap(): void
    {
        require config('admin.bootstrap', admin_path('bootstrap.php'));
    }

    public function getMenus(): array
    {
        $user = $this->user();
        if ($user?->isAdministrator()) {
            $list = Menu::query()->orderBy('order')->where('hidden', false)->get();
        } else {
            $userRolesData = $user?->roles()->with(['permissions.menus' => fn ($q) => $q->where('hidden', false), 'menus' => fn ($q) => $q->where('hidden', false)])->get();
            //权限绑定的菜单
            $permissionMenus = $userRolesData->pluck('permissions')->flatten()->pluck('menus')->flatten();
            //角色绑定的菜单
            $list = $userRolesData->pluck('menus')->flatten()->merge($permissionMenus)->unique('id')->filter(fn ($item) => !$item->hidden)->sortBy('order');
        }

        $list = $list->map(function (Menu $menu) {
            if ($menu->uri_type == 'route') {
                $menu->uri = Str::start($menu->uri, '/');
            }
            $menu->active_menus = array_merge($menu->active_menus ?? [], [$menu->key]);

            return $menu;
        });


        return [
            'active_menus' => $list->pluck('active_menus', 'key')->toArray(),
            'menus' => arr2tree($list->toArray()),
        ];
    }

    /**
     * 取用户实例
     *
     * @return Authenticatable|null
     */
    public function user(): ?Authenticatable
    {
        return $this->guard()->user();
    }

    /**
     * 取看守器
     *
     * @return Guard|StatefulGuard
     */
    public function guard(): Guard|StatefulGuard
    {
        $guard = config('admin.auth.guard') ?: 'admin';
        return Auth::guard($guard);
    }

    public function getHeaderToolbars()
    {
        return app('admin.headerToolbar');
    }
}
