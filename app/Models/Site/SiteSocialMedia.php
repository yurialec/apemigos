<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSocialMedia extends Model
{
    use HasFactory;
    protected $table = 'site_social_media';

    protected $fillable = [
        'name',
        'url',
        'icon',
    ];
}
