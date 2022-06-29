<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers\Form;

/**
 * @method $this extractValue($v)
 * @method $this joinValues($v)
 * @method $this delimiter($v)
 * @method $this allowCity($v)
 * @method $this allowDistrict($v)
 * @method $this allowStreet($v)
 * @method $this searchable($v)
 */
class InputCity extends FormBase
{
    public string $type = 'input-city';
}
