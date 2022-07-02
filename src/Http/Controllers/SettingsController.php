<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2022-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Http\Controllers;

use Larva\Admin\Components\Form;
use Larva\Admin\Components\Grid;
use Larva\Admin\Renderers\Date;
use Larva\Admin\Renderers\Form\InputText;
use Larva\Admin\Renderers\Form\Radios;
use Larva\Settings\SettingEloquent;
use Larva\Settings\SettingsManager;

/**
 * 配置管理
 *
 * @author Tongle Xu <xutongle@msn.com>
 */
class SettingsController extends AdminController
{
    protected function grid(): Grid
    {
        return Grid::make(SettingEloquent::query(), 'admin.settings', function (Grid $grid) {
            $grid->usePage()->title('配置管理');
            $grid->useCRUD()->columnsTogglable(false);
            $grid->builder()->orderBy('id', 'desc');
            $grid->disableBulkDelete()->dialogForm();
            $grid->column('id', 'ID')->width(40)->sortable(true);
            $grid->column('name', '名称')->quickEdit(true)->width(150);
            $grid->column('key', 'Key')->width(200);
            $grid->column('value', 'Value');
            $grid->column('desc', '描述')->quickEdit(true)->width(300);
            $grid->column('cast_type', '类型')->width(40);
            $grid->column('updated_at', '最后更新')->sortable(true)->useTableColumn(Date::make()->datetime())->width(150);
            $grid->actions(function (Grid\Actions $actions) {
                $actions->rowAction();
            });

            //搜索配置
            $grid->filter(function (Grid\Filter $filter) {
                $filter->wrapWithPanel(false)->className('mb-3 bg-search p-2 pt-3');
                $filter->like('name', '名称')->useFormItem()->size('sm');
                $filter->like('key', 'Key')->useFormItem()->size('sm');
            });
        });
    }

    /**
     * 编辑表单
     *
     * @return Form
     */
    protected function form(): Form
    {
        return Form::make(SettingEloquent::query(), 'admin.settings', function (Form $form) {
            $form->customLayout([
                $form->item('name', '配置名称')->required()->useFormItem(),
                $form->item('key', '配置项 Key')
                    ->required()
                    ->createRules(['unique:settings'], ['unique' => '配置项已存在'])
                    ->updateRules(["unique:settings,key,$this->resourceKey"], ['unique' => '配置项已存在'])
                    ->useFormItem(),

                $form->item('value', '配置值')->required()->useFormItem(),

                $form->item('cast_type', '类型')->required()
                    ->useFormItem(Radios::make()->options(SettingsManager::TYPES)),

                $form->item('desc', '描述')->useFormItem(InputText::make()),
            ]);
        });
    }
}