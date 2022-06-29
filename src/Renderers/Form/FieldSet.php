<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this titlePosition($v)
 * @method $this collapsable($v)
 * @method $this collapsed($v)
 * @method $this body($v)
 * @method $this title($v)
 * @method $this collapseTitle($v)
 * @method $this mountOnEnter($v)
 * @method $this unmountOnExit($v)
 * @method $this subFormMode($v)
 * @method $this subFormHorizontal($v)
 */
class FieldSet extends FormBase
{
    public string $type = 'fieldset';
}
