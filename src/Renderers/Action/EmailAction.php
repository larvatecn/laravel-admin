<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Action;

/**
 * @method $this to($v)
 * @method $this cc($v)
 * @method $this bcc($v)
 * @method $this subject($v)
 * @method $this body($v)
 */
class EmailAction extends Button
{
    public string $actionType = 'email';
}
