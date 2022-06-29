<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this actions($v)
 * @method $this actionsClassName($v)
 * @method $this body($v)
 * @method $this bodyClassName($v)
 * @method $this footer($v)
 * @method $this footerClassName($v)
 * @method $this footerWrapClassName($v)
 * @method $this header($v)
 * @method $this headerClassName($v)
 * @method $this title($v)
 * @method $this affixFooter($v)
 * @method $this subFormMode($v)
 * @method $this subFormHorizontal($v)
 */
class Panel extends BaseSchema
{
    public string $type = 'panel';
}
