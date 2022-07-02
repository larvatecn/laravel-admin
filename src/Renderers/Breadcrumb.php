<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * 面包屑导航渲染器
 *
 * @method $this itemClassName($v)
 * @method $this separator($v)
 * @method $this separatorClassName($v)
 * @method $this dropdownClassName($v)
 * @method $this dropdownItemClassName($v)
 * @method $this items($v)
 * @method $this labelMaxLength($v)
 * @method $this tooltipPosition($v)
 */
class Breadcrumb extends BaseSchema
{
    public string $type = 'breadcrumb';
}
