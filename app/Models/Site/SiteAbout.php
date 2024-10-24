<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteAbout extends Model
{
    use HasFactory;

    protected $table = 'site_about';

    protected $fillable = [
        'title',
        'description',
        'image',
    ];
}
