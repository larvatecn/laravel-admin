<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method self tabs($v)
 * @method self source($v)
 * @method self tabsClassName($v)
 * @method self tabsMode($v)
 * @method self contentClassName($v)
 * @method self linksClassName($v)
 * @method self mountOnEnter($v)
 * @method self unmountOnExit($v)
 * @method self toolbar($v)
 * @method self subFormMode($v)
 * @method self subFormHorizontal($v)
 * @method self addable($v)
 * @method self closable($v)
 * @method self draggable($v)
 * @method self showTip($v)
 * @method self showTipClassName($v)
 * @method self editable($v)
 * @method self scrollable($v)
 * @method self sidePosition($v)
 * @method self addBtnText($v)
 */
class Tabs extends BaseSchema
{
    public string $type = 'tabs';
}
