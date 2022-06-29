<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this label($v)
 * @method $this icon($v)
 * @method $this tooltipClassName($v)
 * @method $this trigger($v)
 * @method $this title($v)
 * @method $this content($v)
 * @method $this placement($v)
 * @method $this rootClose($v)
 * @method $this shape($v)
 */
class Remark extends BaseSchema
{
    public string $type = 'remark';
}
