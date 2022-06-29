<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this className($v)
 * @method $this name($v)
 * @method $this placeholder($v)
 * @method $this mini($v)
 * @method $this searchImediately($v)
 */
class SearchBox extends BaseSchema
{
    public string $type = 'search-box';
}
