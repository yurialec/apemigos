<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Services\Site\MainTextService;
use Illuminate\Http\Request;

class MainTextController extends Controller
{
    protected $mainTextService;
    public function __construct(MainTextService $mainTextService)
    {
        $this->mainTextService = $mainTextService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('site.maintext.index');
    }

    public function list()
    {
        $mainText = $this->mainTextService->getAll();

        if ($mainText) {
            return response()->json([
                'status' => true,
                'mainText' => $mainText
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
        return view('site.maintext.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mainTex = $this->mainTextService->create($request->all());

        if ($mainTex) {
            return response()->json([
                'status' => true,
                'mainTex' => $mainTex,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar conteúdo principal'
            ], 204);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mainText = $this->mainTextService->getById($id);

        return view('site.maintext.edit', compact('mainText'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $main = $this->mainTextService->update($id, $request->all());

        if ($main) {
            return response()->json([
                'status' => true,
                'main' => $main,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar conteudo'
            ], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $main = $this->mainTextService->delete($id);

        if ($main) {
            return response()->json([
                'status' => true,
                'message' => 'Conteúdo excluido com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir conteúdo'
            ], 204);
        }
    }
}
