<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'label', 'icon', 'url', 'active', 'son'
    ];

    public function children()
    {
        return $this->hasMany(Menu::class, 'son');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'son');
    }
}
