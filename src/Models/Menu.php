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
 * 菜单模型
 * @property int $id
 * @property int $parent_id
 * @property int $order
 *
 * @author Tongle Xu <xutongle@msn.com>
 */
class Menu extends Model
{
    use HasDateTimeFormatter;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_menus';

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'params' => 'json',
        'active_menus' => 'json',
    ];

    /**
     * A menu has and belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        $relatedModel = config('admin.database.roles_model');
        return $this->belongsToMany($relatedModel, 'admin_role_menus', 'menu_id', 'role_id');
    }
}
