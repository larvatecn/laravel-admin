<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Larva\Admin\Traits\HasDateTimeFormatter;

/**
 * 权限模型
 *
 * @author Tongle Xu <xutongle@msn.com>
 */
class Permission extends Model
{
    use HasDateTimeFormatter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_permissions';

    public function roles(): BelongsToMany
    {
        $relatedModel = config('admin.database.roles_model');
        return $this->belongsToMany($relatedModel, 'admin_role_permissions', 'permission_id', 'role_id');
    }

    public function menus(): BelongsToMany
    {
        $relatedModel = config('admin.database.menu_model');
        return $this->belongsToMany($relatedModel, 'admin_permission_menus', 'permission_id', 'menu_id')->withTimestamps();
    }
}
