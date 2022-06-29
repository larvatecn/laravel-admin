<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this name($v)
 * @method $this map($v)
 * @method $this source($v)
 * @method $this placeholder($v)
 */
class Mapping extends BaseSchema
{
    public string $type = 'map';
}
