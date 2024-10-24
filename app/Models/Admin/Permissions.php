<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    protected $table = 'permissions';
    protected $with = 'module';

    protected $fillable = [
        'name',
        'label',
        'module_id'
    ];

    public function module()
    {
        return $this->belongsTo(Modules::class);
    }
}
