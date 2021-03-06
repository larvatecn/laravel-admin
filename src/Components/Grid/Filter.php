<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Grid;

use Closure;
use Larva\Admin\Components\Form\Item;
use Larva\Admin\Renderers\Button;
use Larva\Admin\Renderers\Form\AmisForm;

/**
 * @method $this title($v)
 * @method $this submitText($v)
 * @method $this columnCount($v)
 * @method $this body($v)
 */
class Filter extends AmisForm
{
    private array $filterItems = [];
    private array $filterField = [];

    public function __construct()
    {
        $this->title('搜索');
        $this->submitText('');
        $this->mode('inline')->wrapWithPanel(false)->className('mb-3 bg-search px-2 pt-3');
    }

    protected function addItem($name = '', $label = ''): Item
    {
        $searchName = "search.$name";

        $item = new Item($searchName, $label);
        $item->size('md');
        $this->filterItems[] = $item;
        return $item;
    }

    private function addField($field, $type, Closure $fun = null): void
    {
        $item = [
            'field' => $field,
            'type' => $type,
            'fun' => $fun
        ];
        $this->filterField[] = $item;
    }

    public function getFilterField(): array
    {
        return $this->filterField;
    }

    public function renderBody(): array
    {
        $items = [];
        if (count($this->filterField) > 0) {
            foreach ($this->filterItems as $item) {
                /*@var Item $item */
                $items[] = $item->render();
            }
            $items[] = Button::make()->label('搜索')->type('submit')->level('primary');
            $items[] = Button::make()->label('重置')->type('reset');
        }
        return $items;
    }

    public function where($name, $label = '', Closure $fun = null): Item
    {
        $this->addField($name, 'where', $fun);
        return $this->addItem($name, $label);
    }

    public function eq($name, $label = ''): Item
    {
        $this->addField($name, 'eq');
        return $this->addItem($name, $label);
    }

    public function like($name, $label): Item
    {
        $this->addField($name, 'like');
        return $this->addItem($name, $label);
    }

    public function between($name, $label): Item
    {
        $this->addField($name, 'between');
        return $this->addItem($name, $label);
    }

    public function in($name, $label): Item
    {
        $this->addField($name, 'in');
        return $this->addItem($name, $label);
    }

    public function notIn($name, $label): Item
    {
        $this->addField($name, 'notIn');
        return $this->addItem($name, $label);
    }
}
