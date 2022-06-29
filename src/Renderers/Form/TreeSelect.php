<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * 树型选择框
 * @method self hideRoot($v)
 * @method self rootLabel($v)
 * @method self rootValue($v)
 * @method self showIcon($v)
 * @method self cascade($v)
 * @method self withChildren($v)
 * @method self onlyChildren($v)
 * @method self onlyLeaf($v)
 * @method self rootCreatable($v)
 * @method self hideNodePathLabel($v)
 * @method self enableNodePath($v)
 * @method self pathSeparator($v)
 * @method self showOutline($v)
 */
class TreeSelect extends FormOptions
{
    public string $type = 'tree-select';
}
