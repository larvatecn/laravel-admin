<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this value($v)
 * @method $this max($v)
 * @method $this min($v)
 * @method $this step($v)
 * @method $this unit($v)
 * @method $this showSteps($v)
 * @method $this parts($v)
 * @method $this marks($v)
 * @method $this tooltipVisible($v)
 * @method $this tooltipPlacement($v)
 * @method $this multiple($v)
 * @method $this joinValues($v)
 * @method $this delimiter($v)
 * @method $this showInput($v)
 * @method $this disabled($v)
 */
class InputRange extends FormBase
{
    public string $type = 'input-range';
}
