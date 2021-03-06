<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * AnchorNav 锚点导航渲染器
 *
 * @method self links($v)
 * @method self active($v)
 * @method self className($v)
 * @method self linkClassName($v)
 * @method self sectionClassName($v)
 * @method self direction($v)
 * */
class AnchorNav extends BaseSchema
{
    public string $type = 'anchor-nav';
}
