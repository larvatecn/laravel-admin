<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Grid;

use Closure;
use Larva\Admin\Renderers\Action\DialogAction;

trait GridDialogForm
{
    protected bool $isDialogForm = false;

    protected DialogForm $dialogForm;

    /**
     * 弹窗表单模式
     * @param string|null $size xs、sm、md、lg、xl、full
     * @param Closure|null $closure
     * @return DialogForm
     */
    public function dialogForm(string $size = null, Closure $closure = null): DialogForm
    {
        $this->isDialogForm = true;

        $this->dialogForm = new DialogForm($this);

        $this->dialogForm->size($size);

        if ($closure) {
            $closure($this->dialogForm);
        }

        return $this->dialogForm;
    }

    public function renderDialogForm($api, $edit = false): DialogAction
    {
        return $this->dialogForm->render($api, $edit);
    }

    public function isDialogForm(): bool
    {
        return $this->isDialogForm;
    }
}
