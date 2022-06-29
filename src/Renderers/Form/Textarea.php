<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this maxRows($v)
 * @method $this minRows($v)
 * @method $this readOnly($v)
 * @method $this borderMode($v)
 * @method $this maxLength($v)
 * @method $this showCounter($v)
 * @method $this clearable($v)
 * @method $this resetValue($v)
 */
class Textarea extends FormBase
{
    public string $type = 'textarea';
}
