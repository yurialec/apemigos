<?php

namespace App\Repositories\Site;

use App\Interfaces\Site\SocialMediaRepositoryInterface;
use App\Models\Site\SiteSocialMedia;

class SocialMediaRepository implements SocialMediaRepositoryInterface
{
    protected $socialMedia;

    public function __construct(SiteSocialMedia $socialMedia)
    {
        $this->socialMedia = $socialMedia;
    }

    public function all()
    {
        return $this->socialMedia->get();
    }

    public function find($id)
    {
        return $this->socialMedia->find($id);
    }

    public function create(array $data)
    {
        return $this->socialMedia->create($data);
    }

    public function update($id, $data)
    {
        $socialMedia = $this->socialMedia->find($id);
        $socialMedia->update($data);

        return $socialMedia;
    }

    public function delete($id)
    {
        $socialMedia = $this->socialMedia->find($id);
        if ($socialMedia) {
            $socialMedia->delete();
            return true;
        }
        return false;
    }
}
