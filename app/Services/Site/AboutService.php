<?php

namespace App\Services\Site;

use App\Repositories\Site\AboutRepository;
use Exception;
use Illuminate\Support\Facades\Storage;

class AboutService
{
    protected $aboutRepository;

    public function __construct(AboutRepository $aboutRepository)
    {
        $this->aboutRepository = $aboutRepository;
    }

    public function getAll()
    {
        return $this->aboutRepository->all();
    }

    public function getById($id)
    {
        return $this->aboutRepository->find($id);
    }

    public function create($data)
    {
        $image = $data['image'];
        $image_urn = $image->store('site/about/images', 'public');

        $data['image'] = $image_urn;

        return $this->aboutRepository->create($data);
    }

    public function update($id, $data)
    {
        $about = $this->aboutRepository->find($id);

        if (isset($data['image'])) {
            Storage::disk('public')->delete($about->image);

            $image = $data['image'];
            $data['image_urn'] = $image->store('site/about/images', 'public');
        } else {
            unset($data['image_urn']);
        }

        return $this->aboutRepository->update($id, $data);
    }

    public function delete($id)
    {
        $about = $this->aboutRepository->find($id);

        if (isset($about->image)) {
            Storage::disk('public')->delete($about->image);
        }

        return $this->aboutRepository->delete($id);
    }
}
