<?php

namespace App\Services\Site;

use App\Repositories\Site\LogoRepository;
use Illuminate\Support\Facades\Storage;

class LogoService
{
    protected $logoRepository;

    public function __construct(LogoRepository $logoRepository)
    {
        $this->logoRepository = $logoRepository;
    }

    public function getAllLogo()
    {
        return $this->logoRepository->all();
    }

    public function getLogoById($id)
    {
        return $this->logoRepository->find($id);
    }

    public function createLogo($data)
    {
        $image = $data['image'];
        $image_urn = $image->store('site/logo/images', 'public');

        $data['image'] = $image_urn;

        return $this->logoRepository->create($data);
    }

    public function updateLogo($id, $data)
    {
        $logo = $this->logoRepository->find($id);

        if (isset($logo->image)) {
            Storage::disk('public')->delete($logo->image);
        }

        if (isset($data['imageFile'])) {
            $image = $data['imageFile'];
            $data['image_urn'] = $image->store('site/logo/images', 'public');
        } else {
            unset($data['image_urn']);
        }

        return $this->logoRepository->update($id, $data);
    }

    public function deleteLogo($id)
    {
        $logo = $this->logoRepository->find($id);
        if (isset($logo->image)) {
            Storage::disk('public')->delete($logo->image);
        }

        return $this->logoRepository->delete($id);
    }
}
