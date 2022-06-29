<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * 模板渲染器
 * @method self tpl($v)
 * @method self html($v)
 * @method self text($v)
 * @method self raw($v)
 * @method self inline($v)
 * @method self style($v)
 * @method self badge($v)
 */
class Tpl extends BaseSchema
{
    public string $type = 'tpl';
}
