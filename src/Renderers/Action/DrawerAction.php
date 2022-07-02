<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Action;

use Larva\Admin\Renderers\Button;

/**
 * @method $this drawer($v)
 * @method $this nextCondition($v)
 * @method $this reload($v)
 * @method $this redirect($v)
 */
class DrawerAction extends Button
{
    public string $actionType = 'drawer';
}
