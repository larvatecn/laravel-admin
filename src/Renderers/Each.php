<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method self name($v)
 * @method self source($v)
 * @method self items($v)
 * @method self placeholder($v)
 */
class Each extends BaseSchema
{
    public string $type = 'each';
}
