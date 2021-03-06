<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this clearable($v)
 * @method $this format($v)
 * @method $this inputFormat($v)
 * @method $this utc($v)
 * @method $this emebed($v)
 * @method $this borderMode($v)
 */
class InputDate extends FormBase
{
    public string $type = 'input-date';

    public function __construct()
    {
        $this->format('YYYY-MM-DD HH:mm:ss');
    }
}
