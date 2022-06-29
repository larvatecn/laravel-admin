<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this blank($v)
 * @method $this href($v)
 * @method $this body($v)
 * @method $this badge($v)
 * @method $this htmlTarget($v)
 * @method $this icon($v)
 * @method $this rightIcon($v)
 */
class Link extends BaseSchema
{
    public string $type = 'link';
}
