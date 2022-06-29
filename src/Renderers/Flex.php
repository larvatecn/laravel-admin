<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Renderers;

/**
 * @method $this justify($v)
 * @method $this alignItems($v)
 * @method $this alignContent($v)
 * @method $this direction($v)
 * @method $this items($v)
 * @method $this style($v)
 */
class Flex extends BaseSchema
{
    public string $type = 'flex';

    public function __construct()
    {
        $this->justify('start')->alignItems('start');
    }
}
