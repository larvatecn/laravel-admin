<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this delimiter($v)
 * @method $this format($v)
 * @method $this inputFormat($v)
 * @method $this joinValues($v)
 * @method $this maxDate($v)
 * @method $this minDate($v)
 * @method $this maxDuration($v)
 * @method $this minDuration($v)
 * @method $this value($v)
 * @method $this borderMode($v)
 * @method $this embed($v)
 * @method $this ranges($v)
 * @method $this startPlaceholder($v)
 * @method $this endPlaceholder($v)
 */
class InputDateRange extends FormBase
{
    public string $type = 'input-date-range';
}
