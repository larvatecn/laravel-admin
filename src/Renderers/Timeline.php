<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this items($v)
 * @method $this source($v)
 * @method $this mode($v)
 * @method $this direction($v)
 * @method $this reverse($v)
 */
class Timeline extends BaseSchema
{
    public string $type = 'timeline';
}
