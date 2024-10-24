<?php

namespace App\Services\Site;

use App\Repositories\Site\ContactRepository;

class ContactService
{
    protected $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getAll()
    {
        return $this->contactRepository->all();
    }

    public function getById($id)
    {
        return $this->contactRepository->find($id);
    }

    public function create($data)
    {
        return $this->contactRepository->create($data);
    }

    public function update($id, $data)
    {
        $contactRepository = $this->contactRepository->find($id);
        return $this->contactRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->contactRepository->delete($id);
    }
}
