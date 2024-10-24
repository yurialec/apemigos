<?php

namespace App\Repositories\Admin;

use App\Interfaces\Admin\ModuleRepositoryInterface;
use App\Models\Admin\Modules;

class ModuleRepository implements ModuleRepositoryInterface
{
    protected $modules;

    public function __construct(Modules $modules)
    {
        $this->modules = $modules;
    }

    public function all()
    {
        return $this->modules->get();
    }
}
