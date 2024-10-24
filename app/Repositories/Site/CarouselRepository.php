<?php

namespace App\Repositories\Site;

use App\Interfaces\Site\CarouselRepositoryInterface;
use App\Models\Site\SiteCarousel;

class CarouselRepository implements CarouselRepositoryInterface
{
    protected $carousel;

    public function __construct(SiteCarousel $carousel)
    {
        $this->carousel = $carousel;
    }

    public function all()
    {
        return $this->carousel->get();
    }

    public function find($id)
    {
        return $this->carousel->find($id);
    }

    public function create(array $data)
    {
        $createData['image'] = $data['image'];

        if (isset($data['title'])) {
            $createData['title'] = $data['title'];
        }

        if (isset($data['description'])) {
            $createData['description'] = $data['description'];
        }

        if (isset($data['url_link'])) {
            $createData['url_link'] = $data['url_link'];
        }

        if (isset($data['name_link'])) {
            $createData['name_link'] = $data['name_link'];
        }

        return $this->carousel->create($createData);
    }

    public function update($id, $data)
    {
        $carousel = $this->carousel->find($id);

        $updateData = [
            'title'       => null,
            'description' => null,
            'url_link'    => null,
            'name_link'   => null,
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

        if (isset($data['url_link'])) {
            $updateData['url_link'] = $data['url_link'];
        }

        if (isset($data['name_link'])) {
            $updateData['name_link'] = $data['name_link'];
        }

        $carousel->update($updateData);

        return $carousel;
    }

    public function delete($id)
    {
        $carousel = $this->carousel->find($id);
        if ($carousel) {
            $carousel->delete();
            return true;
        }
        return false;
    }
}
