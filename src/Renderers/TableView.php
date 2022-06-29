<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this width($v)
 * @method $this padding($v)
 * @method $this border($v)
 * @method $this borderColor($v)
 * @method $this caption($v)
 * @method $this trs($v)
 * @method $this cols($v)
 */
class TableView extends BaseSchema
{
    public string $type = 'table-view';
}
