<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * 音频渲染器
 * @method $this inline($v)
 * @method $this src($v)
 * @method $this loop($v)
 * @method $this autoPlay($v)
 * @method $this rates($v)
 * @method $this controls($v)
 */
class Audio extends BaseSchema
{
    public string $type = 'audio';
}
