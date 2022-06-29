<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this borderMode($v)
 * @method $this menuClassName($v)
 * @method $this cascade($v)
 * @method $this withChildren($v)
 * @method $this onlyChildren($v)
 * @method $this onlyLeaf($v)
 * @method $this hideNodePathLabel($v)
 */
class NestedSelect extends FormOptions
{
    public string $type = 'nested-select';
}
