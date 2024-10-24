<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Carousel\StoreCarouselRequest;
use App\Http\Requests\Site\Carousel\UpdateCarouselRequest;
use App\Services\Site\CarouselService;
use Illuminate\Http\Request;

class SiteCarouselController extends Controller
{
    protected $carouselService;
    public function __construct(CarouselService $carouselService)
    {
        $this->carouselService = $carouselService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('site.carousel.index');
    }

    public function list()
    {
        $carousels = $this->carouselService->getAll();

        if ($carousels) {
            return response()->json([
                'status' => true,
                'carousels' => $carousels
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
        return view('site.carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarouselRequest $request)
    {
        $carousel = $this->carouselService->create($request->all());

        if ($carousel) {
            return response()->json([
                'status' => true,
                'carousel' => $carousel,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar carousel'
            ], 204);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carousel = $this->carouselService->getById($id);
        return view('site.carousel.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarouselRequest $request, string $id)
    {
        $carousel = $this->carouselService->update($id, $request->all());

        if ($carousel) {
            return response()->json([
                'status' => true,
                'carousel' => $carousel,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar carousel'
            ], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $carousel = $this->carouselService->delete($id);

        if ($carousel) {
            return response()->json([
                'status' => true,
                'message' => 'Carousel excluido com sucesso',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao excluir Carousel'
            ], 204);
        }
    }
}
