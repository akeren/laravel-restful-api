<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\RolePermission
 *
 * @property int $id
 * @property int $role_id
 * @property int $permission_id
 * @method static \Illuminate\Database\Eloquent\Builder|RolePermission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RolePermission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RolePermission query()
 * @method static \Illuminate\Database\Eloquent\Builder|RolePermission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolePermission wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RolePermission whereRoleId($value)
 * @mixin \Eloquent
 */
class RolePermission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $timestamps = false;
}
