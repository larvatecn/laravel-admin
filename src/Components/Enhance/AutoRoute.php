<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Enhance;

use JsonSerializable;
use Larva\Admin\Renderers\Tpl;

class AutoRoute implements JsonSerializable
{
    use AutoRouteAction;

    public static function make()
    {
        return new static();
    }


    public function render()
    {
        return Tpl::make();
    }

    public function jsonSerialize()
    {
        return $this->render();
    }
}
