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

    public function action()
    {
        try {
            $data = request()?->all();
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
            return $res ?? Admin::responseMessage('操作成功');
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
                'file' => 'mimes:' . config('admin.upload.mimes', 'jpeg,bmp,png,gif,jpg')
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
                'file' => 'mimes:' . config('amis-admin.upload.file_mimes', '')
            ]);
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
            $type = $request->file('type');
            $path = $request->input('path', 'images');
            $uniqueName = $request->boolean('unique_name', config('admin.upload.uniqueName', false));
            $disk = config('admin.upload.disk');
            $name = $file->getClientOriginalName();
            if ($uniqueName) {
                $path = $file->store($path, $disk);
            } else {
                $path = $file->storeAs($path, $name, $disk);
            }
            $url = Storage::disk($disk)->url($path);
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
