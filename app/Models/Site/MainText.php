<?php

namespace App\Models\Site;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainText extends Model
{
    use HasFactory;

    protected $table = 'site_main_text';

    protected $fillable = ['title', 'text'];
}
