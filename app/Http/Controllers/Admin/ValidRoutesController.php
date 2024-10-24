<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\ValidRouteService;
use Illuminate\Http\Request;

class ValidRoutesController extends Controller
{
    protected $validRouteService;
    public function __construct(ValidRouteService $validRouteService)
    {
        $this->validRouteService = $validRouteService;
    }

    public function index()
    {
        $routes = $this->validRouteService->getAllRoutes();

        if ($routes) {
            return response()->json([
                'status' => true,
                'routes' => $routes
            ], 200);
        } else {
            return response()->json([
                'message' => 'Nenhum registro encontrado.',
                'status' => 204
            ]);
        }
    }
}
