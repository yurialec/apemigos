<?php

namespace App\Repositories\Blog;

use App\Interfaces\Blog\BlogRepositoryInterface;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BlogRepository implements BlogRepositoryInterface
{
    protected $blog;
    protected $blogImages;

    public function __construct(Blog $blog, BlogImages $blogImages)
    {
        $this->blog = $blog;
        $this->blogImages = $blogImages;
    }

    public function all()
    {
        return $this->blog->get();
    }

    public function find($id)
    {
        return $this->blog->find($id);
    }

    public function create(array $data)
    {
        DB::transaction(function () use ($data) {
            $blog = $this->blog->create([
                'title' => $data['title'],
                'description' => $data['description'],
                'user_id' => Auth::id(),
            ]);

            foreach ($data['images'] as $imagePath) {
                $this->blogImages->insert([
                    'image_path' => $imagePath,
                    'order' => 0,
                    'blog_id' => $blog->id,
                ]);
            }

            return $blog;
        });
    }

    public function update($id, $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $blog = $this->blog->find($id);

            $blog->update([
                'title' => $data['title'],
                'description' => $data['description'],
            ]);

            $this->blogImages->where('blog_id', $id)
                ->whereNotIn('image_path', $data['old_data'])
                ->delete();

            if (isset($data['images'])) {
                foreach ($data['images'] as $imagePath) {
                    $this->blogImages->create([
                        'image_path' => $imagePath,
                        'order' => 0,
                        'blog_id' => $id,
                    ]);
                }
            }

            return $blog;
        });
    }

    public function delete($id)
    {
        $blog = $this->blog->find($id);
        if ($blog) {
            $blog->delete();
            return true;
        }
        return false;
    }
}
