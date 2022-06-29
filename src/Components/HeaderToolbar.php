<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Components;

use Illuminate\Support\Collection;
use JsonSerializable;
use Larva\Admin\Facades\Admin;
use Larva\Admin\Renderers\Action\LinkAction;
use Larva\Admin\Renderers\Action\UrlAction;
use Larva\Admin\Renderers\DropdownButton;

class HeaderToolbar implements JsonSerializable
{
    protected Collection $left;
    protected Collection $right;

    public function __construct()
    {
        $this->left = collect([]);
        $this->right = collect([]);
    }

    public function left($element): HeaderToolbar
    {
        $this->left->add($element);
        return $this;
    }

    public function right($element): HeaderToolbar
    {
        $this->right->add($element);
        return $this;
    }


    private function initUserInfo()
    {
        $userinfo = DropdownButton::make()->align('right')->trigger('hover');

        $user = Admin::user();

        $buttons = collect([]);

        $buttons->add(
            LinkAction::make()
                ->label('个人设置')
                ->icon('fa-solid fa-gear mr-2')
                ->link(admin_route('/user_setting')),
        );

        $buttons->add(
            UrlAction::make()
                ->label('退出登录')
                ->icon('fa-solid fa-arrow-right-from-bracket mr-2')
                ->url(route('admin.logout'))
                ->confirmText('确定退出登录吗？'),
        );


        $userinfo->label($user->name)
            ->buttons($buttons->toArray());

        $this->right->add($userinfo);
    }

    public function jsonSerialize(): array
    {
        $this->initUserInfo();

        return [
            'left' => $this->left->toArray(),
            'right' => $this->right->toArray(),
        ];
    }
}
