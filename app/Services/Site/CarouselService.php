<?php

namespace App\Services\Site;

use App\Repositories\Site\CarouselRepository;
use Illuminate\Support\Facades\Storage;

class CarouselService
{
    protected $carouselRepository;

    public function __construct(CarouselRepository $carouselRepository)
    {
        $this->carouselRepository = $carouselRepository;
    }

    public function getAll()
    {
        return $this->carouselRepository->all();
    }

    public function getById($id)
    {
        return $this->carouselRepository->find($id);
    }

    public function create($data)
    {
        $image = $data['image'];
        $image_urn = $image->store('site/carousel/images', 'public');

        $data['image'] = $image_urn;

        return $this->carouselRepository->create($data);
    }

    public function update($id, $data)
    {
        $carousel = $this->carouselRepository->find($id);

        if (isset($data['image'])) {
            Storage::disk('public')->delete($carousel->image);

            $image = $data['image'];
            $data['image_urn'] = $image->store('site/carousel/images', 'public');
        } else {
            unset($data['image_urn']);
        }

        return $this->carouselRepository->update($id, $data);
    }

    public function delete($id)
    {
        $logo = $this->carouselRepository->find($id);
        if (isset($logo->image)) {
            Storage::disk('public')->delete($logo->image);
        }

        return $this->carouselRepository->delete($id);
    }
}
