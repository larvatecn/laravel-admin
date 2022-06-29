<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Grid;

use Larva\Admin\Components\Grid;

trait GridFilter
{
    private Filter $filter;

    /**
     * 查询过滤器
     * @param $fun
     * @return Grid
     */
    public function filter($fun): Grid
    {
        $this->crud->filterTogglable(true);
        $fun($this->filter);
        return $this;
    }

    public function getFilterField(): array
    {
        return $this->filter->getFilterField();
    }


    private function buildFilter(): void
    {
        $this->filter->body($this->filter->renderBody());
    }

    private function renderFilter()
    {
        $this->buildFilter();

        return $this->filter;
    }
}
