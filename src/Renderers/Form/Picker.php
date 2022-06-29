<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this labelTpl($v)
 * @method $this labelField($v)
 * @method $this valueField($v)
 * @method $this pickerSchema($v)
 * @method $this modalMode($v)
 * @method $this embed($v)
 */
class Picker extends FormOptions
{
    public string $type = 'picker';
}
