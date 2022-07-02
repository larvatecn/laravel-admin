<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Admin
 * @mixin \Larva\Admin\Admin
 * @see \Larva\Admin\Admin
 * @author Tongle Xu <xutongle@msn.com>
 */
class Admin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'admin';
    }
}
