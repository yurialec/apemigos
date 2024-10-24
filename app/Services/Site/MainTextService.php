<?php

namespace App\Services\Site;

use App\Repositories\Site\MainTextRepository;
use Illuminate\Support\Facades\Storage;

class MainTextService
{
    protected $mainTextRepository;

    public function __construct(MainTextRepository $mainTextRepository)
    {
        $this->mainTextRepository = $mainTextRepository;
    }

    public function getAll()
    {
        return $this->mainTextRepository->all();
    }

    public function getById($id)
    {
        return $this->mainTextRepository->find($id);
    }

    public function create($data)
    {
        return $this->mainTextRepository->create($data);
    }

    public function update($id, $data)
    {
        $mainTextRepository = $this->mainTextRepository->find($id);
        return $this->mainTextRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->mainTextRepository->delete($id);
    }
}
