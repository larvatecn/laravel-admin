<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Form;

trait FormActions
{
    protected Actions $actions;

    //禁用操作
    protected bool $disableAction = false;

    /**
     * 禁用所有操作
     * @return $this
     */
    public function disableAction(): self
    {
        $this->disableAction = true;
        return $this;
    }
}
