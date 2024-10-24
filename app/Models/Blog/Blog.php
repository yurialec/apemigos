<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = ['title', 'description', 'user_id'];

    protected $with = ['images', 'user'];

    public function images()
    {
        return $this->hasMany(BlogImages::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
