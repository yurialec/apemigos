<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogImages extends Model
{
    use HasFactory;
    protected $table = 'blog_images';
    protected $fillable = ['blog_id', 'image_path', 'order'];
}
