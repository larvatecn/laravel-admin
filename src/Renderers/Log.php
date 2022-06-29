<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this className($v)
 * @method $this source($v)
 * @method $this height($v)
 * @method $this autoScroll($v)
 * @method $this encoding($v)
 * @method $this maxLength($v)
 * @method $this rowHeight($v)
 * @method $this disableColor($v)
 */
class Log extends BaseSchema
{
    public string $type = 'log';
}
