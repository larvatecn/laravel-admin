<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * 开关控件
 * @method self trueValue($v)
 * @method self falseValue($v)
 * @method self option($v)
 * @method self onText($v)
 * @method self offText($v)
 */
class AmisSwitch extends FormBase
{
    public string $type = 'switch';
}
