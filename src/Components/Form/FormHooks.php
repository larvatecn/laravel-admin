<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components\Form;

use Closure;
use Illuminate\Support\Arr;
use Larva\Admin\Components\Form;

trait FormHooks
{
    protected array $hooks = [];

    protected function registerHook($name, Closure $callback): self
    {
        $this->hooks[$name][] = $callback;
        return $this;
    }

    protected function callHooks($name, $parameters = []): void
    {
        $hooks = Arr::get($this->hooks, $name, []);
        foreach ($hooks as $func) {
            if (!$func instanceof Closure) {
                continue;
            }
            $func($this, $parameters);
        }
    }

    /**
     * 修改前回调
     *
     * @param Closure $callback
     * @return Form
     */
    public function editing(Closure $callback): Form
    {
        return $this->registerHook('editing', $callback);
    }

    /**
     *
     * @param Closure $callback
     * @return Form
     */
    public function editData(Closure $callback): Form
    {
        return $this->registerHook('editData', $callback);
    }

    /**
     * 提交后回调
     *
     * @param Closure $callback
     * @return Form
     */
    public function submitted(Closure $callback): Form
    {
        return $this->registerHook('submitted', $callback);
    }

    /**
     * 保存前回调
     *
     * @param Closure $callback
     * @return Form
     */
    public function saving(Closure $callback): Form
    {
        return $this->registerHook('saving', $callback);
    }

    /**
     * 保存后回调
     *
     * @param Closure $callback
     * @return Form
     */
    public function saved(Closure $callback): Form
    {
        return $this->registerHook('saved', $callback);
    }

    /**
     * 删除前回调
     *
     * @param Closure $callback
     * @return Form
     */
    public function deleting(Closure $callback): Form
    {
        return $this->registerHook('deleting', $callback);
    }

    /**
     * 删除后回调
     *
     * @param Closure $callback
     * @return Form
     */
    public function deleted(Closure $callback): Form
    {
        return $this->registerHook('deleted', $callback);
    }

    public function transaction(Closure $callback): Form
    {
        return $this->registerHook('transaction', $callback);
    }

    public function validating(Closure $callback): Form
    {
        return $this->registerHook('validating', $callback);
    }

    public function useRules(Closure $callback): Form
    {
        return $this->registerHook('useRules', $callback);
    }

    protected function callEditing($id): void
    {
        $this->callHooks('editing', $id);
    }

    protected function callEdiData($data): void
    {
        $this->callHooks('editData', $data);
    }

    protected function callSubmitted(): void
    {
        $this->callHooks('submitted');
    }

    protected function callSaving(): void
    {
        $this->callHooks('saving');
    }

    protected function callSaved(): void
    {
        $this->callHooks('saved');
    }

    protected function callDeleting($id): void
    {
        $this->callHooks('deleting', $id);
    }

    protected function callDeleted(): void
    {
        $this->callHooks('deleted');
    }

    protected function callTransaction(): void
    {
        $this->callHooks('transaction');
    }

    protected function callUseRules($rules): void
    {
        $this->callHooks('useRules', $rules);
    }

    protected function callValidating($validator): void
    {
        $this->callHooks('validating', $validator);
    }
}
