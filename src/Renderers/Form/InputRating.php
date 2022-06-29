<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this count($v)
 * @method $this half($v)
 * @method $this allowClear($v)
 * @method $this readonly($v)
 * @method $this colors($v)
 * @method $this inactiveColor($v)
 * @method $this texts($v)
 * @method $this textPosition($v)
 * @method $this char($v)
 * @method $this charClassName($v)
 * @method $this textClassName($v)
 */
class InputRating extends FormBase
{
    public string $type = 'input-rating';
}
