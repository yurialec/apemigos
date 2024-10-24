<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ModuleRepository;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    protected $moduleRepository;
    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
    }
    public function list()
    {
        $modules = $this->moduleRepository->all();

        if ($modules) {
            return response()->json([
                'status' => true,
                'modules' => $modules
            ], 200);
        } else {
            return response()->json([
                'message' => 'Nenhum registro encontrado.',
                'status' => 204
            ]);
        }
    }
}
