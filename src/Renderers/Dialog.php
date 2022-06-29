<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this actions($v)
 * @method $this body($v)
 * @method $this bodyClassName($v)
 * @method $this closeOnEsc($v)
 * @method $this closeOnOutside($v)
 * @method $this name($v)
 * @method $this size($v)
 * @method $this title($v)
 * @method $this header($v)
 * @method $this headerClassName($v)
 * @method $this footer($v)
 * @method $this confirm($v)
 * @method $this showCloseButton($v)
 * @method $this showErrorMsg($v)
 * @method $this showLoading($v)
 */
class Dialog extends BaseSchema
{
    public string $type = 'dialog';
}
