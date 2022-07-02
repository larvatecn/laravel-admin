<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Form;

use Closure;
use Larva\Admin\Renderers\BaseSchema;
use Larva\Admin\Renderers\Form\AmisForm;

trait FormMain
{
    private AmisForm $form;
    private array $items = [];

    protected BaseSchema|array|null $customLayout = null;

    /**
     * 添加表单项
     * @param string $name
     * @param string $label
     * @return Item
     */
    public function item(string $name = '', string $label = ''): Item
    {
        return $this->addItem($name, $label);
    }

    protected function addItem($name = '', $label = ''): Item
    {
        $item = new Item($name, $label);
        $this->items[] = $item;
        return $item;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * 自定义布局
     * @param BaseSchema|array|Closure $customLayout
     * @return $this
     */
    public function customLayout(BaseSchema|array|Closure $customLayout): self
    {
        if ($customLayout instanceof Closure) {
            $customLayout = $customLayout();
        }
        $this->customLayout = $customLayout;
        return $this;
    }

    /**
     * 获取 Amis Form 对象
     * @return AmisForm
     */
    public function useForm(): AmisForm
    {
        return $this->renderForm();
    }

    /**
     * 获取表单提交地址
     * @return string
     */
    private function getAction(): string
    {
        if ($this->isEdit) {
            return $this->getUpdateUrl($this->editKey);
        }
        return $this->getStoreUrl();
    }

    /**
     * 渲染表单
     *
     * @return AmisForm
     */
    public function renderForm(): AmisForm
    {
        //表单项配置
        if ($this->customLayout) {
            $items = $this->customLayout;
        } else {
            $items = [];
            foreach ($this->items as $item) {
                /*@var Item $item */
                $items[] = $item->render();
            }
        }

        //提交地址
        $this->form->api($this->getAction());

        //初始化编辑数据
        if ($this->isEdit && $this->editData) {
            $this->actions->disableReset();
            $this->form->data($this->getEditData());
        }
        //添加操作配置
        if (!$this->disableAction) {
            $this->form->actions($this->actions->render());
        }
        //弹窗表单设置
        if ($this->isDialog()) {
            $this->form->wrapWithPanel(false);
        } else {
            //提交后行为
            $this->form->redirect('back()');
        }

        $this->form->body($items);

        return $this->form;
    }
}
