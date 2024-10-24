<?php

namespace App\Repositories\Site;

use App\Interfaces\Site\MainTextRepositoryInterface;
use App\Models\Site\MainText;

class MainTextRepository implements MainTextRepositoryInterface
{
    protected $mainText;

    public function __construct(MainText $mainText)
    {
        $this->mainText = $mainText;
    }

    public function all()
    {
        return $this->mainText->get();
    }

    public function find($id)
    {
        return $this->mainText->find($id);
    }

    public function create(array $data)
    {
        return $this->mainText->create([
            'title' => $data['title'],
            'text' => $data['text'],
        ]);
    }

    public function update($id, $data)
    {
        $mainText = $this->mainText->find($id);
        $mainText->update($data);

        return $mainText;
    }

    public function delete($id)
    {
        $mainText = $this->mainText->find($id);
        if ($mainText) {
            $mainText->delete();
            return true;
        }
        return false;
    }
}
