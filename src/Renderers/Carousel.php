<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this auto($v)
 * @method $this interval($v)
 * @method $this duration($v)
 * @method $this width($v)
 * @method $this height($v)
 * @method $this controlsTheme($v)
 * @method $this placeholder($v)
 * @method $this controls($v)
 * @method $this animation($v)
 * @method $this itemSchema($v)
 * @method $this name($v)
 * @method $this thumbMode($v)
 * @method $this options($v)
 */
class Carousel extends BaseSchema
{
    public string $type = 'carousel';
}
