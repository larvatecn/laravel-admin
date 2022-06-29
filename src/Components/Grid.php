<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components;

use Illuminate\Database\Eloquent\Builder;
use JsonSerializable;
use Larva\Admin\Components\Grid\Actions;
use Larva\Admin\Components\Grid\Filter;
use Larva\Admin\Components\Grid\GridCRUD;
use Larva\Admin\Components\Grid\GridData;
use Larva\Admin\Components\Grid\GridDialogForm;
use Larva\Admin\Components\Grid\GridToolbar;
use Larva\Admin\Components\Grid\GridTree;
use Larva\Admin\Components\Grid\Model;
use Larva\Admin\Components\Grid\Toolbar;
use Larva\Admin\Renderers\CRUD;
use Larva\Admin\Renderers\Page;

class Grid implements JsonSerializable
{
    use GridCRUD, GridData, GridToolbar, ModelBase, GridTree, GridDialogForm;

    protected Page $page;

    protected string $routeName;
    protected Model $model;

    protected string $_action;

    public function __construct()
    {
        $this->page = Page::make()->title('列表');
        $this->crud = CRUD::make();
        $this->filter = new Filter();
        $this->actions = new Actions($this);
        $this->toolbar = new Toolbar($this);

        $this->_action = (string)request('_action');
    }

    public static function make(Builder $model, string $routeName, $fun): Grid
    {
        $grid = new static();
        $grid->model = new Model($model, $grid);
        $grid->routeName = $routeName;
        $fun($grid);
        return $grid;
    }

    /**
     * 获取AmisPage实例
     * @return Page
     */
    public function usePage(): Page
    {
        return $this->page;
    }

    public function builder(): Builder
    {
        return $this->model->getBuilder();
    }

    public function jsonSerialize()
    {
        //获取数据
        if ($this->_action === 'getData') {
            return $this->buildData();
        }
        $this->page
            ->toolbar($this->toolbar->renderToolbar())
            ->body([
                $this->renderCRUD(),
            ]);

        return $this->page;
    }
}
