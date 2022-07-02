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
use Larva\Admin\Facades\Admin;
use Larva\Admin\Renderers\Action\AjaxAction;
use Larva\Admin\Renderers\Avatar;
use Larva\Admin\Renderers\Date;
use Larva\Admin\Renderers\Each;
use Larva\Admin\Renderers\Flex;
use Larva\Admin\Renderers\Form\Group;
use Larva\Admin\Renderers\Form\InputImage;
use Larva\Admin\Renderers\Form\InputText;
use Larva\Admin\Renderers\Form\Select;
use Larva\Admin\Renderers\Tpl;

class AdministratorController extends AdminController
{
    /**
     * 管理员列表
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $model = config('admin.database.users_model');
        return Grid::make($model::query(), 'admin.user', function (Grid $grid) {
            $grid->usePage()->title('管理员列表');
            $grid->useCRUD()->columnsTogglable(false);
            $grid->disableBulkDelete()->dialogForm();
            $grid->column('id', 'ID')->width(40);
            $grid->column('avatar', '头像')
                ->width(60)
                ->align('center')
                ->useTableColumn(Avatar::make()->src('${avatar}'));
            $grid->column('username', '用户名')->width(100);
            $grid->column('name', '姓名')->width(100);
            $grid->column('roles', '角色')
                ->useTableColumn(Each::make()->items(Tpl::make()->tpl("<span class='label label-default m-l-sm'><%= this.name %></span>")));
            $grid->column('created_at', '创建时间')->width(250)->sortable(true)
                ->useTableColumn(Date::make()->datetime());
            $grid->actions(function (Grid\Actions $actions) {
                $actions->rowAction();
                $actions->callDeleteAction(function (AjaxAction $action) {
                    $id = Admin::user()?->getKey();
                    $action->hiddenOn("id==$id"); //这里使用了显隐判断
                });
            });
        });
    }

    protected function form(): Form
    {
        $model = config('admin.database.users_model');
        $connection = config('admin.database.connection');
        return Form::make($model::query(), 'admin.user', function (Form $form) use ($connection) {
            $form->customLayout([
                Flex::make()
                    ->justify('flex-start')
                    ->alignItems('start')
                    ->items([
                        $form->item('avatar', ' ')->useFormItem(InputImage::make()->placeholder('xxx')),
                        Group::make()->className('flex-1')
                            ->body([
                                $form->item('username', '用户名')
                                    ->required()
                                    ->createRules(["unique:$connection.admin_users"], ['unique' => '用户名已存在'])
                                    ->updateRules(["unique:$connection.admin_users,username,$this->resourceKey"], ['unique' => '用户名已存在'])
                                    ->useFormItem()->columnRatio(12),
                                $form->item('name', '名称')
                                    ->required()
                                    ->useFormItem()->className('mt-2'),
                            ]),
                    ]),
                $form->item('password', '密码')
                    ->rules(['confirmed'], ['confirmed' => '两次密码不一致'])
                    ->createRules(['required', 'string'])
                    ->useFormItem(InputText::make()->password())
                    ->required($this->isCreate),
                $form->item('password_confirmation', '确认密码')
                    ->useFormItem(InputText::make()->password())
                    ->required($this->isCreate),

                $form->item('roles', '角色')
                    ->useFormItem(Select::make()->extractValue(true)
                        ->joinValues(false)
                        ->multiple(true)
                        ->labelField('name')
                        ->valueField('id')
                        ->searchable(true)
                        ->options(function () {
                            /*@var Model $model */
                            $model = config('admin.database.roles_model');
                            return $model::all();
                        })),
            ]);
            $form->editData(function (Form $form) {
                $form->deleteEditData('password');
            });

            $form->saving(function (Form $form) {
                if ($form->password && $form->model()->get('password') != $form->password) {
                    $form->password = bcrypt($form->password);
                }
                if (!$form->password) {
                    $form->deleteInput('password');
                }
            });

//            $form->saving(function (Form $form) {
//                $form->deleteInput('password_confirmation');
//                if ($form->password && $form->model()->get('password') != $form->password) {
//                    $form->password = bcrypt($form->password);
//                }
//            });
        });
    }
}
