<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

declare(strict_types=1);

namespace Larva\Admin\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Larva\Admin\Traits\HasDateTimeFormatter;

/**
 * 管理员模型
 *
 * @author Tongle Xu <xutongle@msn.com>
 */
class Administrator extends Model implements AuthenticatableContract
{
    use Authenticatable, HasPermissions, HasDateTimeFormatter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_users';

    /**
     * A user has and belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        $relatedModel = config('admin.database.roles_model');
        return $this->belongsToMany($relatedModel, 'admin_role_users', 'user_id', 'role_id');
    }
}
