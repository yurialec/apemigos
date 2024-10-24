<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Contact\CreateContactRequest;
use App\Services\Site\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('site.contact.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('site.contact.create');
    }

    public function list()
    {
        $contacts = $this->contactService->getAll();

        if ($contacts) {
            return response()->json([
                'status' => true,
                'contacts' => $contacts
            ], 200);
        } else {
            return response()->json([
                'message' => 'Nenhum registro encontrado.',
                'status' => 204
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateContactRequest $request)
    {
        $contact = $this->contactService->create($request->all());

        if ($contact) {
            return response()->json([
                'status' => true,
                'contact' => $contact,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao cadastrar conteúdo de contato'
            ], 204);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = $this->contactService->getById($id);
        return view('site.contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $contact = $this->contactService->update($id, $request->all());

        if ($contact) {
            return response()->json([
                'status' => true,
                'contact' => $contact,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao atualizar conteudo do contato'
            ], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        $contact = $this->contactService->delete($id);

        if ($contact) {
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
