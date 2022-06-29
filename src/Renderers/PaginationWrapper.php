<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this showPageInput($v)
 * @method $this maxButtons($v)
 * @method $this inputName($v)
 * @method $this outputName($v)
 * @method $this perPage($v)
 * @method $this position($v)
 * @method $this body($v)
 */
class PaginationWrapper extends BaseSchema
{
    public string $type = 'pagination-wrapper';
}
