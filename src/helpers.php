<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

if (!function_exists('admin_path')) {
    /**
     * Get admin path.
     *
     * @param string $path
     * @return string
     */
    function admin_path($path = ''): string
    {
        return ucfirst(config('admin.directory')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('admin_base_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     * @return string
     */
    function admin_base_path($path = '')
    {
        $prefix = '/' . trim(config('admin.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        $path = trim($path, '/');

        if (is_null($path) || strlen($path) == 0) {
            return $prefix ?: '/';
        }
        return $prefix . '/' . $path;
    }
}

if (!function_exists('admin_url')) {
    /**
     * Get admin url.
     *
     * @param string $path
     * @param mixed $parameters
     * @param bool $secure
     * @return string
     */
    function admin_url($path = '', $parameters = [], $secure = null)
    {
        if (URL::isValidUrl($path)) {
            return $path;
        }
        $secure = $secure ?: (config('admin.https') || config('admin.secure'));
        return url($path, $parameters, $secure);
    }
}

if (!function_exists('admin_asset')) {
    function admin_asset($path): string
    {
        return (config('admin.https') || config('admin.secure')) ? secure_asset($path) : asset($path);
    }
}
if (!function_exists('admin_route')) {
    function admin_route($path = ''): string
    {
        $prefix = trim(config('admin.route.prefix'));
        $path = str_replace($prefix . '/', '/', $path);
        return Str::of($path)->finish('/')->start('/')->rtrim('/')->value();
    }
}
function vite_assets(): HtmlString
{
    $devServerIsRunning = false;
    if (app()->environment('local')) {
        try {
            Http::get('http://10.10.10.10:3600');
            $devServerIsRunning = true;
        } catch (Exception) {
        }
    }
    if ($devServerIsRunning) {
        return new HtmlString(
            <<<HTML
            <script type="module" src="http://10.10.10.10:3600/@vite/client"></script>
            <script type="module" src="http://10.10.10.10:3600/resources/js/main.ts"></script>
        HTML
        );
    }
    $manifest = json_decode(file_get_contents(
        public_path('vendor/admin/manifest.json')
    ), true);
    return new HtmlString(
        <<<HTML
        <script type="module" src="/vendor/admin/{$manifest['resources/js/main.ts']['file']}"></script>
        <link rel="stylesheet" href="/vendor/admin/{$manifest['resources/js/main.ts']['css'][0]}">
    HTML
    );
}

function arr2tree($list, $id = 'id', $pid = 'parent_id', $son = 'children')
{
    if (!is_array($list)) {
        $list = collect($list)->toArray();
    }

    [$tree, $map] = [[], []];
    foreach ($list as $item) {
        $map[$item[$id]] = $item;
    }

    foreach ($list as $item) {
        if (isset($item[$pid], $map[$item[$pid]])) {
            $map[$item[$pid]][$son][] = &$map[$item[$id]];
        } else {
            $tree[] = &$map[$item[$id]];
        }
    }
    unset($map);
    return $tree;
}
