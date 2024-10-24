<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\LogoService;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    protected $logoService;
    public function __construct(LogoService $logoService)
    {
        $this->logoService = $logoService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('site.logo.index');
    }

    public function list()
    {
        $logo = $this->logoService->getAllLogo();

        if ($logo) {
            return response()->json([
                'status' => true,
                'logo' => $logo
            ], 200);
        } else {
            return response()->json([
                'message' => 'Nenhum registro encontrado.',
                'status' => 204
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('site.logo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $logo = $this->logoService->createLogo($request->all());

        if ($logo) {
            return response()->json([
                'status' => true,
                'logo' => $logo,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar Logotipo'
            ], 204);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $logo = $this->logoService->getLogoById($id);
        return view('site.logo.edit', compact('logo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $logo = $this->logoService->updateLogo($id, $request->all());

        if ($logo) {
            return response()->json([
                'status' => true,
                'logo' => $logo,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar logotipo'
            ], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $logo = $this->logoService->deleteLogo($id);

        if ($logo) {
            return response()->json([
                'status' => true,
                'message' => 'Logotipo excluido com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir logotipo'
            ], 204);
        }
    }
}
