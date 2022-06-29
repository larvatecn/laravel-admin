<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method self body($v)
 * @method self gap($v)
 * @method self direction($v)
 * @method self subFormMode($v)
 * @method self subFormHorizontal($v)
 */
class Group extends FormBase
{
    public string $type = 'group';

    public function directionVertical()
    {
        $this->direction('vertical');
        return $this;
    }
}
