<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Grid;

use Closure;

trait GridToolbar
{
    protected Toolbar $toolbar;

    /**
     * 禁用新增操作
     * @return $this
     */
    public function disableCreate($bool = true): self
    {
        $this->toolbar->disableCreate($bool);
        return $this;
    }

    /**
     * 工具栏
     * @param Closure $fun
     * @return $this
     */
    public function toolbar(Closure $fun): self
    {
        $fun($this->toolbar);
        return $this;
    }
}
