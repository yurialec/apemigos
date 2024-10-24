<?php

namespace App\Repositories\Site;

use App\Interfaces\Site\LogoRepositoryInterface;
use App\Models\Site\SiteLogo;

class LogoRepository implements LogoRepositoryInterface
{
    protected $logo;

    public function __construct(SiteLogo $logo)
    {
        $this->logo = $logo;
    }

    public function all()
    {
        return $this->logo->first();
    }

    public function find($id)
    {
        return $this->logo->find($id);
    }

    public function create(array $data)
    {
        return $this->logo->create([
            'name' => $data['name'],
            'image' => $data['image'],
        ]);
    }

    public function update($id, $data)
    {
        $logo = $this->logo->find($id);

        $updateData = [
            'name' => $data['name'],
        ];

        if (isset($data['image_urn'])) {
            $updateData['image'] = $data['image_urn'];
        }

        $logo->update($updateData);

        return $logo;
    }

    public function delete($id)
    {
        $logo = $this->logo->find($id);
        if ($logo) {
            $logo->delete();
            return true;
        }
        return false;
    }
}
