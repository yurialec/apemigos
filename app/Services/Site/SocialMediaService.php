<?php

namespace App\Services\Site;

use App\Repositories\Site\SocialMediaRepository;

class SocialMediaService
{
    protected $socialMediaRepository;

    public function __construct(SocialMediaRepository $socialMediaRepository)
    {
        $this->socialMediaRepository = $socialMediaRepository;
    }

    public function getAll()
    {
        return $this->socialMediaRepository->all();
    }

    public function getById($id)
    {
        return $this->socialMediaRepository->find($id);
    }

    public function create($data)
    {
        return $this->socialMediaRepository->create($data);
    }

    public function update($id, $data)
    {
        $socialMediaRepository = $this->socialMediaRepository->find($id);
        return $this->socialMediaRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->socialMediaRepository->delete($id);
    }
}
