<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * Alert 提示渲染器。
 * @method self title($v)
 * @method self body($v)
 * @method self level($v)
 * @method self showCloseButton($v)
 * @method self closeButtonClassName($v)
 * @method self showIcon($v)
 * @method self icon($v)
 * @method self iconClassName($v)
 */
class Alert extends BaseSchema
{
    public string $type = 'alert';
}
