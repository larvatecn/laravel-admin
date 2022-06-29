<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this tpl($v)
 * @method $this text($v)
 * @method $this inline($v)
 * @method $this placeholder($v)
 */
class Plain extends BaseSchema
{
    public string $type = 'plain';
}
