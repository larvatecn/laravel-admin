<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Larva\Admin\Facades\Admin;

/**
 * 控制台基类
 *
 * @author Tongle Xu <xutongle@msn.com>
 */
class AdminController extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var bool 是否创建界面
     */
    protected bool $isCreate = false;

    /**
     * @var bool 是否编辑界面
     */
    protected bool $isEdit = false;

    /**
     * @var bool 是否新增提交
     */
    protected bool $isStore = false;

    /**
     * @var bool 是否修改提交
     */
    protected bool $isUpdate = false;

    /**
     * @var mixed|null 当前更新的id
     */
    protected mixed $resourceKey = null;

    public function index()
    {
        return Admin::response($this->grid());
    }

    public function create()
    {
        $this->isCreate = true;
        return Admin::response($this->form());
    }

    public function edit($id)
    {
        $this->isEdit = true;
        $this->resourceKey = $id;
        return Admin::response($this->form()->edit($id));
    }

    public function update($id)
    {
        $this->resourceKey = $id;
        $this->isUpdate = true;
        if ($id === 'quickSave') {
            return $this->form()->quickUpdate();
        }
        if ($id === 'quickSaveItem') {
            return $this->form()->quickItemUpdate();
        }
        return $this->form()->update($id);
    }

    public function store()
    {
        $this->isStore = true;
        return $this->form()->store();
    }

    public function destroy($id)
    {
        $this->resourceKey = $id;
        return $this->form()->destroy($id);
    }
}
