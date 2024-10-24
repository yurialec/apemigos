<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionsRoles extends Model
{
    use HasFactory;
    protected $table = 'permissions_roles';

    protected $fillable = [
        'permission_id',
        'role_id',
    ];
}
