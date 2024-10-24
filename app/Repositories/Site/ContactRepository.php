<?php

namespace App\Repositories\Site;

use App\Interfaces\Site\ContactRepositoryInterface;
use App\Models\Site\SiteContact;

class ContactRepository implements ContactRepositoryInterface
{
    protected $contact;

    public function __construct(SiteContact $contact)
    {
        $this->contact = $contact;
    }

    public function all()
    {
        return $this->contact->get();
    }

    public function find($id)
    {
        return $this->contact->find($id);
    }

    public function create(array $data)
    {
        return $this->contact->create([
            'phone' => $data['phone'],
            'email' => $data['email'],
            'city' => $data['city'],
            'state' => $data['state'],
            'address' => $data['address'],
            'zipcode' => $data['zipcode'],
        ]);
    }

    public function update($id, $data)
    {
        $contact = $this->contact->find($id);
        $contact->update($data);

        return $contact;
    }

    public function delete($id)
    {
        $contact = $this->contact->find($id);
        if ($contact) {
            $contact->delete();
            return true;
        }
        return false;
    }
}
