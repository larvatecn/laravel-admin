<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2022-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Larva\Admin\Facades\Admin;
use Larva\Admin\Renderers\Button;
use Larva\Admin\Renderers\Form\AmisForm;
use Larva\Admin\Renderers\Form\InputSwitch;
use Larva\Admin\Renderers\Form\InputText;
use Larva\Admin\Renderers\Page;
use Larva\Admin\Renderers\Tab;
use Larva\Admin\Renderers\Tabs;
use Larva\Settings\Facade\Settings;
use Larva\Settings\SettingEloquent;

/**
 * 系统配置
 *
 * @author Tongle Xu <xutongle@msn.com>
 */
class SystemSettingsController extends \Illuminate\Routing\Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 配置首页
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $page = Page::make()->title('系统配置')->toolbar([
            Button::make()->label('保存')->level('primary')->type('submit')->target('setting-form'),
        ]);
        $settings = [];
        SettingEloquent::all()->each(function ($setting) use (&$settings) {
            $settings[$setting['key']] = $setting['value'];
        });

        $form = AmisForm::make()->mode('horizontal')
            ->data($settings)//设置默认数据
            ->name('setting-form')->wrapWithPanel(false)
            ->api(route('admin.system_setting.save'));
        $form->body([
            Tabs::make()
                ->tabsMode('strong')
                ->tabs([
                    Tab::make()
                        ->title('基本设置')
                        ->body([
                            InputText::make()->label('图片后缀')->name('uploader.image_mimes1')->placeholder('允许上传的图片后缀。'),
                        ]),
                    Tab::make()
                        ->title('上传设置')
                        ->body([
                            InputSwitch::make()->label('自动重命名')->name('uploader.unique_name')->hint('是否自动重命名上传文件。'),
                            InputText::make()->label('图片后缀')->name('uploader.image_mimes')->hint('允许上传的图片后缀。')->placeholder('jpeg,bmp,png,gif,jpg'),
                            InputText::make()->label('文件后缀')->name('uploader.file_mimes')->hint('允许上传的文件后缀。')->placeholder('doc,docx'),
                        ]),
                ]),
        ]);
        $page->body($form);
        return Admin::response($page);
    }

    /**
     * 保存设置
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function save(Request $request): JsonResponse
    {
        try {
            $input = Arr::dot($request->all());
            $castTypes = Settings::castTypes();
            foreach ($input as $key => $val) {
                $castType = $castTypes[$key] ?? 'string';
                Settings::set($key, $val, $castType);
            }
            return Admin::responseMessage('保存成功');
        } catch (\Exception $e) {
            return Admin::responseError($e->getMessage());
        }
    }
}