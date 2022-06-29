<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this layout($v)
 * @method $this maxButtons($v)
 * @method $this mode($v)
 * @method $this activePage($v)
 * @method $this total($v)
 * @method $this lastPage($v)
 * @method $this perPage($v)
 * @method $this showPerPage($v)
 * @method $this perPageAvailable($v)
 * @method $this showPageInput($v)
 * @method $this disabled($v)
 * @method $this hasNext($v)
 */
class Pagination extends BaseSchema
{
    public string $type = 'pagination';
}
