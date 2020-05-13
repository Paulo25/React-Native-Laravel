<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ClienteRepository;

class ClienteController extends Controller
{

    /**
     * ClienteController constructor.
     * @param ClienteRepository $clienteRepository
     * @param Request $request
     */
    public function __construct(ClienteRepository $clienteRepository, Request $request)
    {
        $this->clienteRepository = $clienteRepository;
        $this->request = $request;
    }

    /**
     * Retorna uma listagem do recurso.
     */
    public function index()
    {
        return $this->clienteRepository->listar();
    }

    /**
     * Armazena um recurso recém-criado no armazenamento.
     */
    public function store()
    {
        return $this->clienteRepository->salvar($this->request);
    }

    /**
     * Exibe o recurso especificado por Id.
     */
    public function show($id)
    {
        return $this->clienteRepository->BuscarClientePorId($id);
    }

    /**
     * Atualiza o recurso especificado por Id.
     */
    public function update($id)
    {
        return $this->clienteRepository->atualizar($id, $this->request);
    }

    /**
     * Remove o recurso especificado por Id.
     */
    public function destroy($id)
    {
        return $this->clienteRepository->deletar($id);
    }
}
