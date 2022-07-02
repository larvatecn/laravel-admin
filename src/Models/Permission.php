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
 * @property int $id
 * @property int $parent_id
 * @property string $name
 * @property string $slug
 * @property array $http_method
 * @property array $http_path
 * @property int $order
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

    protected $fillable = [
        'name', 'slug'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'http_method' => 'array',
        'http_path' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static array $httpMethods = [
        'GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS', 'HEAD',
    ];

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
