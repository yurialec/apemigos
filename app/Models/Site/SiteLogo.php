<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteLogo extends Model
{
    use HasFactory;

    protected $table = 'site_logo';

    protected $fillable = ['name', 'image'];
}
