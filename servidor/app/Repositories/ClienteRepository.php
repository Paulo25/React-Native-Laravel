<?php

namespace App\Repositories;

use App\Models\Cliente;
use App\Enums\Mensagem;
use App\Enums\StatusCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ClienteRepository
{

    /**
     * ClienteRepository constructor.
     * @param Cliente $cliente
     */
    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    /**
     * Exibe uma listagem do recurso.
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar()
    {

        if (!$data = $this->cliente->all()) {
            return response()->json(['mensagem' => Mensagem::MSG001], StatusCode::NOT_FOUND);
        }

        return response()->json(['results' => $data], StatusCode::OK);
    }

    /**
     * Armazena um recurso na base.
     * @param null $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function salvar($request)
    {
        $dataForm = $request->all();

        try {

            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $extension = $request->image->extension();
                $name = uniqid(date('His'));

                $nameFile = "{$name}.{$extension}";

                $upload = $request->image->storeAs('clientes', $nameFile);

                if (!$upload) {
                    return response()->json(['error' => 'Falha ao fazer upload!'], 500);
                } else {
                    $dataForm['image'] = $nameFile;
                }
            }

            $data = $this->cliente->create($dataForm);

        } catch (\Exception $e) {
            return response()->json([['mensagem' => Mensagem::MSG002], ['Error' => $e->getMessage()]], StatusCode::INTERNAL_SERVER_ERROR);
        }

        return response()->json($data, StatusCode::CREATED);
    }


    /**
     * Buscar o recurso especificado por Id.
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function BuscarClientePorId($id)
    {

        if (!checkId($id))
            return response()->json(['Mensagem' => Mensagem::MSG003], StatusCode::BAD_REQUEST);

        if (!$data = $this->cliente->find($id))
            return response()->json(['Mensagem' => Mensagem::MSG001], StatusCode::NOT_FOUND);

        return response()->json($data, StatusCode::OK);
    }

    /**
     * Atualiza o recurso especificado por Id.
     * @param $id
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function atualizar($id, $request)
    {

        $dataForm = $request->all();

        if (!checkId($id))
            return response()->json(['Mensagem' => Mensagem::MSG003], StatusCode::BAD_REQUEST);

        if (!$data = $this->cliente->find($id))
            return response()->json(['Mensagem' => Mensagem::MSG001], StatusCode::NOT_FOUND);

        try {
            DB::beginTransaction();

            $data->update($dataForm);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([['Mensagem' => Mensagem::MSG002], [$e->getMessage()]], StatusCode::INTERNAL_SERVER_ERROR);
        }

        return response()->json($data, StatusCode::OK);

    }

    /**
     * Remove o recurso especificado por Id.
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletar($id)
    {

        if (!checkId($id))
            return response()->json(['Mensagem' => Mensagem::MSG003], StatusCode::BAD_REQUEST);

        if (!$data = $this->cliente->find($id))
            return response()->json(['Mensagem' => Mensagem::MSG001], StatusCode::NOT_FOUND);

        try {
            if ($data->image) {
                Storage::disk('public')->delete("/clientes/$data->image");
            }

            $data->delete();
        } catch (\Exception $e) {
            return response()->json([['Mensagem' => Mensagem::MSG002], [$e->getMessage()]], StatusCode::INTERNAL_SERVER_ERROR);
        }

        return response()->json(['Mensagem' => Mensagem::MSG004], StatusCode::OK);

    }

}
