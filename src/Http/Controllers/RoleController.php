<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin\Http\Controllers;

use Larva\Admin\Components\Form;
use Larva\Admin\Components\Grid;
use Larva\Admin\Models\Permission;
use Larva\Admin\Renderers\Alert;
use Larva\Admin\Renderers\Form\Checkboxes;
use Larva\Admin\Renderers\Form\Group;
use Larva\Admin\Renderers\Form\InputTree;
use Larva\Admin\Renderers\Tab;
use Larva\Admin\Renderers\Tabs;

/**
 * 角色管理
 *
 * @author Tongle Xu <xutongle@msn.com>
 */
class RoleController extends AdminController
{
    protected function grid(): Grid
    {
        $model = config('admin.database.roles_model');
        return Grid::make($model::query(), 'admin.role', function (Grid $grid) {
            $grid->usePage()->title('角色管理');

            $grid->column('id', 'ID');
            $grid->column('name', '角色名称');
            $grid->column('slug', '角色标识');
            $grid->dialogForm('lg');
            $grid->actions(function (Grid\Actions $actions) {
                $actions->rowAction();
            });
        });
    }

    protected function form(): Form
    {
        $model = config('admin.database.roles_model');
        return Form::make($model::query(), 'admin.role', function (Form $form) {
            $form->customLayout([
                Group::make()->body([
                    $form->item('name', '角色名称')->useFormItem()->required(true),
                    $form->item('slug', '角色标识')->useFormItem()->required(true),
                ]),
                Tabs::make()
                    ->tabsMode('chrome')
                    ->tabs([
                        Tab::make()->title('权限设置')->body(function () use ($form) {
                            return $form->item('permissions', ' ')->useFormItem(Checkboxes::make()->extractValue(true)
                                ->joinValues(false)
                                ->labelField('name')
                                ->valueField('id')
                                ->options(function () {
                                    $list = Permission::query()
                                        ->orderBy('order')->get()->toArray();
                                    return arr2tree($list);
                                }));
                        }),
                        Tab::make()->title('菜单设置')->body(function () use ($form) {
                            return [
                                Alert::make()->body('这里选择的菜单会与权限绑定的菜单合并')->showIcon(true),
                                $form->item('menus', ' ')->useFormItem(InputTree::make()
                                    ->extractValue(true)
                                    ->joinValues(false)
                                    ->labelField('title')
                                    ->valueField('id')
                                    ->multiple(true)
                                    ->cascade(true)
                                    ->showOutline(true)
                                    ->options(function () {
                                        $model = config('admin.database.menu_model');
                                        $list = $model::query()
                                            ->orderBy('order')->get()->toArray();
                                        return arr2tree($list);
                                    })),
                            ];
                        }),
                    ]),
            ]);
        });
    }
}
