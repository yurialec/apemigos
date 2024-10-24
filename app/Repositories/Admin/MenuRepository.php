<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\MenuRepositoryInterface;
use App\Models\Admin\Menu;
use Exception;

class MenuRepository implements MenuRepositoryInterface
{
    protected $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    public function all($term)
    {
        return $this->menu
            ->when($term, function ($query) use ($term) {
                return $query->where('name', 'like', '%' . $term . '%');
            })
            ->whereNull('son')
            ->paginate(10);
    }

    public function find($id)
    {
        return $this->menu
            ->find($id)
            ->with('children')
            ->whereNull('son')
            ->where('id', $id)
            ->get();
    }

    public function create(array $data)
    {
        return $this->menu->create([
            'label' => $data['label'],
            'icon' => $data['icon'],
            'url' => '#',
            'active' => 1,
            'son' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    public function update($id, $data)
    {
        $menu = $this->menu->find($id);

        if (isset($data['children'])) {
            foreach ($data['children'] as $childData) {
                $child = $this->menu->children()->find($childData['id'] ?? null);
                if ($child) {
                    $child->update($childData);
                } else {
                    $menu->children()->create($childData);
                }
            }
        }

        return $menu;
    }

    public function delete($id)
    {
        $menu = $this->menu->find($id);

        if ($menu) {
            $this->deleteSubmenus($menu);
            $menu->delete();

            return true;
        }

        return false;
    }

    protected function deleteSubmenus(Menu $menu)
    {
        foreach ($menu->children as $submenu) {
            $this->deleteSubmenus($submenu);
            $submenu->delete();
        }
    }
}
