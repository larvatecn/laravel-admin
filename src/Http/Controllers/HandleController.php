<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Larva\Admin\Facades\Admin;
use Larva\Settings\Facade\Settings;

class HandleController extends AdminController
{
    /**
     * 顶部工具
     *
     * @return JsonResponse
     */
    public function headerToolbar(): JsonResponse
    {
        $toolbars = Admin::getHeaderToolbars();
        return Admin::response($toolbars);
    }

    /**
     * 菜单
     *
     * @return JsonResponse
     */
    public function menu(): JsonResponse
    {
        $menus = Admin::getMenus();
        return Admin::response($menus);
    }

    /**
     * @return JsonResponse|mixed
     */
    public function action(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Admin::validatorData($data, [
                'action' => 'required|string',
                'class' => 'required|string',
                'params' => 'array',
            ]);
            if ($validator->fails()) {
                abort(400, $validator->errors()->first());
            }
            $class = Crypt::decryptString($data['class']);
            $action = $data['action'];
            $params = $data['params'];
            $res = (new $class())->$action($params);
            return $res ?? Admin::responseMessage('操作成功！');
        } catch (Exception $e) {
            return Admin::responseError($e->getMessage());
        }
    }

    /**
     * 图片上传
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadImage(Request $request): JsonResponse
    {
        try {
            Admin::validatorData($request->all(), [
                'file' => 'mimes:' . Settings::get('uploader.image_mimes', 'jpeg,bmp,png,gif,jpg')
            ]);
            return $this->upload($request);
        } catch (Exception $exception) {
            return Admin::responseError($exception->getMessage());
        }
    }

    /**
     * 文件上传
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function uploadFile(Request $request): JsonResponse
    {
        try {
            Admin::validatorData($request->all(), [
                'file' => 'mimes:' . Settings::get('uploader.file_mimes', '')
            ]);
            $request->merge(['page' => 'files']);
            return $this->upload($request);
        } catch (Exception $exception) {
            return Admin::responseError($exception->getMessage());
        }
    }

    /**
     * 上传处理
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function upload(Request $request): JsonResponse
    {
        try {
            $file = $request->file('file');
            $path = $request->input('path', 'images');
            $uniqueName = $request->boolean('unique_name', Settings::get('uploader.unique_name', true));
            $name = $file->getClientOriginalName();
            if ($uniqueName) {
                $path = $file->store($path);
            } else {
                $path = $file->storeAs($path, $name);
            }
            $url = Storage::disk()->url($path);
            $data = [
                'value' => $path,
                'filename' => $name,
                'url' => $url,
                'link' => $url,
            ];
            return Admin::response($data);
        } catch (Exception $exception) {
            return Admin::responseError($exception->getMessage());
        }
    }
}
