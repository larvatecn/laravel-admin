<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this columns($v)
 * @method $this gap($v)
 * @method $this valign($v)
 * @method $this align($v)
 */
class GridSchema extends BaseSchema
{
    public string $type = 'grid';
}
