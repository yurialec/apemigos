<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $with = 'permissions';

    public function permissions()
    {
        return $this->hasManyThrough(
            Permissions::class,
            PermissionsRoles::class,
            'role_id',
            'id',
            'id',
            'permission_id',
        );
    }
}
