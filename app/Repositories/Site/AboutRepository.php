<?php

namespace App\Repositories\Site;

use App\Interfaces\Site\AboutRepositoryInterface;
use App\Models\Site\SiteAbout;

class AboutRepository implements AboutRepositoryInterface
{
    protected $about;

    public function __construct(SiteAbout $about)
    {
        $this->about = $about;
    }

    public function all()
    {
        return $this->about->get();
    }

    public function find($id)
    {
        return $this->about->find($id);
    }

    public function create(array $data)
    {
        if (isset($data['image'])) {
            $createData['image'] = $data['image'];
        }

        if (isset($data['title'])) {
            $createData['title'] = $data['title'];
        }

        if (isset($data['description'])) {
            $createData['description'] = $data['description'];
        }

        return $this->about->create($createData);
    }

    public function update($id, $data)
    {
        $about = $this->about->find($id);

        $updateData = [
            'title'       => null,
            'description' => null,
        ];

        if (isset($data['image_urn'])) {
            $updateData['image'] = $data['image_urn'];
        }

        if (isset($data['title'])) {
            $updateData['title'] = $data['title'];
        }

        if (isset($data['description'])) {
            $updateData['description'] = $data['description'];
        }

        $about->update($updateData);

        return $about;
    }

    public function delete($id)
    {
        $about = $this->about->find($id);
        if ($about) {
            $about->delete();
            return true;
        }
        return false;
    }
}
