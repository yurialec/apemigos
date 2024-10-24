<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteCarousel extends Model
{
    use HasFactory;

    protected $table = 'site_carrousel';

    protected $fillable = [
        'title',
        'description',
        'image',
        'name_link',
        'url_link',
    ];
}
