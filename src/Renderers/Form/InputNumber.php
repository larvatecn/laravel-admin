<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method self max($v)
 * @method self min($v)
 * @method self step($v)
 * @method self precision($v)
 * @method self showSteps($v)
 * @method self borderMode($v)
 * @method self prefix($v)
 * @method self suffix($v)
 * @method self unitOptions($v)
 * @method self kilobitSeparator($v)
 * @method self readOnly($v)
 * @method self keyboard($v)
 * @method self displayMode($v)
 */
class InputNumber extends FormBase
{
    public string $type = 'input-number';
}
