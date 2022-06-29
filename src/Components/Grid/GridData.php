<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Grid;

use Closure;

trait GridData
{
    public ?Closure $callRows = null;
    public ?Closure $callRow = null;

    /**
     * 处理数据集合
     * @param Closure $closure
     * @return $this
     */
    public function useRows(Closure $closure): self
    {
        $this->callRows = $closure;
        return $this;
    }

    /**
     * 处理每一条数据
     * @param Closure $closure
     * @return $this
     */
    public function useRow(Closure $closure): self
    {
        $this->callRow = $closure;
        return $this;
    }

    protected function buildData(): array
    {
        return $this->model->buildData();
    }
}
