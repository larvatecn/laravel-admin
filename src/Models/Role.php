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
 * 角色模型
 *
 * @author Tongle Xu <xutongle@msn.com>
 */
class Role extends Model
{
    use HasDateTimeFormatter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_roles';

    public function administrators(): BelongsToMany
    {
        $relatedModel = config('admin.database.users_model');
        return $this->belongsToMany($relatedModel, 'admin_role_users', 'role_id', 'user_id');
    }

    public function permissions(): BelongsToMany
    {
        $relatedModel = config('admin.database.permissions_model');
        return $this->belongsToMany($relatedModel, 'admin_role_permissions', 'role_id', 'permission_id');
    }

    public function menus(): BelongsToMany
    {
        $relatedModel = config('admin.database.menu_model');
        return $this->belongsToMany($relatedModel, 'admin_role_menus', 'role_id', 'menu_id');
    }
}
