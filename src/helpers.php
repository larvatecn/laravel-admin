<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

use Illuminate\Support\Facades\URL;

/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

function admin_path($path = ''): string
{
    return ucfirst(config('admin.directory')) . ($path ? DIRECTORY_SEPARATOR . $path : $path);
}

function admin_base_path($path = ''): string
{
    $prefix = '/' . trim(config('admin.route.prefix'), '/');

    $prefix = ($prefix === '/') ? '' : $prefix;

    $path = trim($path, '/');

    if (is_null($path) || $path === '') {
        return $prefix ?: '/';
    }
    return $prefix . '/' . $path;
}

function admin_url($path = '', $parameters = [], $secure = null)
{
    if (URL::isValidUrl($path)) {
        return $path;
    }
    $secure = $secure ?: (config('admin.https') || config('admin.secure'));
    return url($path, $parameters, $secure);
}
