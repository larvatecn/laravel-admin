<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this placeholder($v)
 * @method $this multiple($v)
 * @method $this draggable($v)
 * @method $this draggableTip($v)
 * @method $this addable($v)
 * @method $this removable($v)
 * @method $this minLength($v)
 * @method $this maxLength($v)
 * @method $this labelField($v)
 * @method $this btnLabel($v)
 * @method $this addButtonText($v)
 * @method $this addButtonClassName($v)
 * @method $this itemClassName($v)
 * @method $this itemsClassName($v)
 * @method $this showErrorMsg($v)
 * @method $this form($v)
 * @method $this scaffold($v)
 */
class InputSubForm extends FormBase
{
    public string $type = 'input-sub-form';
}
