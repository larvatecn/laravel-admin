<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Table;

use Larva\Admin\Renderers\BaseSchema;

/**
 * 数据表渲染器
 * @method $this affixHeader($v)
 * @method $this columns($v)
 * @method $this columnsTogglable($v)
 * @method $this footable($v)
 * @method $this footerClassName($v)
 * @method $this headerClassName($v)
 * @method $this placeholder($v)
 * @method $this showFooter($v)
 * @method $this showHeader($v)
 * @method $this source($v)
 * @method $this tableClassName($v)
 * @method $this title($v)
 * @method $this toolbarClassName($v)
 * @method $this combineNum($v)
 * @method $this combineFromIndex($v)
 * @method $this prefixRow($v)
 * @method $this affixRow($v)
 * @method $this resizable($v)
 * @method $this rowClassNameExpr($v)
 * @method $this itemBadge($v)
 * @method $this autoGenerateFilter($v)
 */
class Table extends BaseSchema
{
    public string $type = 'table';
}
