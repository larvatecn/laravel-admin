<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this header($v)
 * @method $this body($v)
 * @method $this media($v)
 * @method $this actions($v)
 * @method $this toolbar($v)
 * @method $this secondary($v)
 */
class Card extends BaseSchema
{
    public string $type = 'card';
}
