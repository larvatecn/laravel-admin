<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Larva\Admin\Components\Form;
use Larva\Admin\Components\Grid;
use Larva\Admin\Facades\Admin;
use Larva\Admin\Models\Permission;
use Larva\Admin\Renderers\Action\AjaxAction;
use Larva\Admin\Renderers\Alert;
use Larva\Admin\Renderers\Each;
use Larva\Admin\Renderers\Form\Checkboxes;
use Larva\Admin\Renderers\Form\Group;
use Larva\Admin\Renderers\Form\InputTree;
use Larva\Admin\Renderers\Form\Select;
use Larva\Admin\Renderers\Form\Transfer;
use Larva\Admin\Renderers\Form\TreeSelect;
use Larva\Admin\Renderers\Tab;
use Larva\Admin\Renderers\Tabs;
use Larva\Admin\Renderers\Tpl;

class PermissionController extends AdminController
{
    private string $routeName = 'admin.permission';

    protected function grid()
    {
        $model = config('admin.database.permissions_model');
        return Grid::make($model::query(), $this->routeName, function (Grid $grid) {
            $grid
                ->loadDataOnce()
                ->toTree()
                ->disableBulkDelete();

            $grid->useCRUD()
                ->expandConfig([
                    'expand' => 'all'
                ])
                ->columnsTogglable(false)
                ->perPage(100)
                ->keepItemSelectionOnPageChange(true);


            $grid->usePage()->title('权限管理')->remark('在这里你可以管理权限');

            $grid->column('slug', '标识')->useTableColumn()->copyable(true);
            $grid->column('name', '名称')->inputText();
            $grid->column('http_method', '请求方式')
                ->useTableColumn(Each::make()->placeholder("<span class='label label-default'>ANY</span>")
                    ->items(Tpl::make()->tpl("<span class='label label-default m-l-sm'><%= this.item %></span>")));
            $grid->column('http_path', '路由')
                ->useTableColumn(Each::make()->items(Tpl::make()->tpl("<span class='label label-default m-l-sm'><%= this.item %></span>")));

            $grid->column('menus', '菜单')
                ->useTableColumn(Each::make()->items(Tpl::make()->tpl("<span class='label label-success m-l-sm'><%= this.title %></span>")));


            $grid->dialogForm('lg');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->wrapWithPanel(false)->className('mb-3 bg-search p-2 pt-3');
                $filter->like('slug', '标识')->useFormItem()->clearable(true)->size('sm');
                $filter->like('name', '名称')->useFormItem()->clearable(true)->size('sm');
            });

            $grid->actions(function (Grid\Actions $actions) {
                $actions->width(200);
                $actions->rowAction();
            });

            $grid->toolbar(function (Grid\Toolbar $toolbar) {
                $api = 'get:' . route('admin.permission.auto-generate');
                $action = AjaxAction::make()->label('自动生成权限')
                    ->confirmText('确定要自动生成权限吗？')
                    ->level('success')->api($api);
                $toolbar->addHeaderToolbar($action);
            });
        });
    }

    protected function form(): Form
    {
        $model = config('admin.database.permissions_model');
        return Form::make($model::query(), $this->routeName, function (Form $form) use ($model) {
            $form->customLayout([
                Group::make()
                    ->body([
                        $form->item('parent_id', '父级')
                            ->useFormItem(TreeSelect::make()->options(function () use ($model) {
                                $list = $model::query()->orderBy('order')->get()->toArray();
                                return arr2tree($list);
                            })->labelField('name')->valueField('id')->value(0)),
                        $form->item('slug', '标识')
                            ->required()
                            ->useFormItem(),
                        $form->item('name', '名称')
                            ->useFormItem()->required(true),
                    ]),
                $form->item('http_method', '请求方式')
                    ->useFormItem(Checkboxes::make()->multiple(true)
                        ->extractValue(true)
                        ->joinValues(false)
                        ->options($this->getHttpMethods())),

                Tabs::make()
                    ->tabsMode('chrome')
                    ->className('mb-2')
                    ->tabs([
                        Tab::make()->title('路由设置')->body(function () use ($form) {
                            return $form->item('http_path', ' ')
                                ->useFormItem(Transfer::make()->options($this->getRoutes())
                                    ->extractValue(true)
                                    ->joinValues(false)
                                    ->searchable(true)
                                    ->multiple(true)
                                    ->clearable(true));
                        }),
                        Tab::make()->title('菜单设置')->body(function () use ($form) {
                            return [
                                Alert::make()->body('权限与菜单绑定，当用户拥有该权限时，菜单将会显示，可以简化角色与菜单当权限的绑定操作')->showIcon(true),
                                $form->item('menus', ' ')
                                    ->useFormItem(InputTree::make()
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
                                        }))];
                        }),
                    ]),
                $form->item('roles', '授权角色')
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
        });
    }

    public function getRoutes(): array
    {
        $prefix = (string)config('admin.route.prefix');

        $container = collect();
        $routes = collect(app('router')->getRoutes())->map(function ($route) use ($prefix, $container) {
            if (!Str::startsWith($uri = $route->uri(), $prefix) && $prefix && $prefix !== '/') {
                return null;
            }
            if (!Str::contains($uri, '{')) {
                if ($prefix !== '/') {
                    $route = Str::replaceFirst($prefix, '', $uri . '*');
                } else {
                    $route = $uri . '*';
                }
                if ($route !== '*') {
                    $container->push($route);
                }
            }
            $path = preg_replace('/{.*}+/', '*', $uri);
            if ($prefix !== '/') {
                return Str::replaceFirst($prefix, '', $path);
            }
            return $path;
        });
        return $container->merge($routes)->filter()->unique()->map(function ($method) {
            return [
                'value' => $method,
                'label' => $method
            ];
        })->values()->all();
    }

    private function getHttpMethods(): array
    {
        $permissionModel = config('admin.database.permissions_model');
        return collect($permissionModel::$httpMethods)->map(function ($method) {
            return [
                'value' => $method,
                'label' => $method
            ];
        })->toArray();
    }

    public function autoGenerate()
    {
        $routes = $this->getRoutes();
        $excepts = config('admin.permission.excepts', []);
        $routes = collect($routes)->filter(function ($route) {
            return Str::contains($route['value'], '*')
                && !Str::endsWith($route['value'], '/*')
                && !Str::endsWith($route['value'], ['edit', 'edit*', 'create*', 'create']);
        })->map(function ($route) {
            return $route['value'];
        })->filter(function ($route) use ($excepts) {
            return !Str::contains($route, $excepts);
        })->values()->all();
        $contain = [];
        foreach ($routes as $route) {
            foreach ($routes as $route2) {
                if ($route != $route2 && Str::is($route, $route2)) {
                    $contain[] = $route2;
                }
            }
        }
        $routes = collect($routes)->filter(function ($route) use ($contain) {
            return !in_array($route, $contain);
        })->values()->all();
        /*@var Permission $model */
        $model = config('admin.database.permissions_model');

        foreach ($routes as $route) {
            $slug = str_replace(array('*', '/'), '', $route);
            $name = $slug;
            $http_path = [$route];
            $model::query()
                ->firstOrCreate([
                    'slug' => $slug,
                ], [
                    'name' => $name,
                    'http_path' => $http_path,
                ]);
        }
        return Admin::responseMessage('权限自动生成成功');
    }
}
