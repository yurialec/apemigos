<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContact extends Model
{
    use HasFactory;

    protected $table = 'site_contact';

    protected $fillable = [
        'phone',
        'email',
        'city',
        'state',
        'address',
        'zipcode',
    ];
}
