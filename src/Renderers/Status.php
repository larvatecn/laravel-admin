<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * 状态渲染器
 * @method self placeholder($v)
 * @method self map($v)
 * @method self labelMap($v)
 *
 */
class Status extends BaseSchema
{
    public string $type = 'status';
}
