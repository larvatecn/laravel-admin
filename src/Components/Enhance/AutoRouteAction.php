<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Enhance;

use Illuminate\Support\Facades\Crypt;

trait AutoRouteAction
{
    /**
     * API 配置对象类型
     *
     * https://aisuda.bce.baidu.com/amis/zh-CN/docs/types/api#%E5%A4%8D%E6%9D%82%E9%85%8D%E7%BD%AE
     * @param string $actionName
     * @param array $params
     * @param string $method
     * @return array
     */
    public function action(string $actionName, array $params = [], string $method = 'post'): array
    {
        $class = Crypt::encryptString($this::class);
        $data = [
            'class' => $class,
            'action' => $actionName,
            'params' => $params
        ];
        return [
            'method' => $method,
            'url' => urldecode(route('admin.handle-action', $params)),
            'data' => $data,
        ];
    }
}
