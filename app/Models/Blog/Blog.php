<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = ['blog_id', 'image_path'];

    protected $with = ['blog'];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
