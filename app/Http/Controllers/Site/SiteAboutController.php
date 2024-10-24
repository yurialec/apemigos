<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\AboutService;
use Illuminate\Http\Request;

class SiteAboutController extends Controller
{
    protected $aboutService;
    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('site.about.index');
    }

    public function list()
    {
        $abouts = $this->aboutService->getAll();

        if ($abouts) {
            return response()->json([
                'status' => true,
                'abouts' => $abouts
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
        return view('site.about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $about = $this->aboutService->create($request->all());

        if ($about) {
            return response()->json([
                'status' => true,
                'about' => $about,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar configuração'
            ], 204);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $about = $this->aboutService->getById($id);
        return view('site.about.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about = $this->aboutService->update($id, $request->all());

        if ($about) {
            return response()->json([
                'status' => true,
                'about' => $about,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar Contrúdo Sobre'
            ], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $about = $this->aboutService->delete($id);

        if ($about) {
            return response()->json([
                'status' => true,
                'message' => 'Conteúdo Sobre excluido com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir Conteúdo Sobre'
            ], 204);
        }
    }
}
