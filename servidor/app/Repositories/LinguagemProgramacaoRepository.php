<?php

namespace App\Repositories;


use App\Enums\Mensagem;
use App\Enums\StatusCode;
use App\Models\LinguagemProgramacao;

class LinguagemProgramacaoRepository
{

    public function __construct(LinguagemProgramacao $linguagemProgramacao)
    {
        $this->linguagemProgramacao = $linguagemProgramacao;
    }

    /**
     * Exibe uma listagem do recurso.
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar()
    {
        if(!$data = $this->linguagemProgramacao->all()){
            return response()->json(['Mensagem' => Mensagem::MSG001], StatusCode::NOT_FOUND);
        }

        return response()->json(['results' => $data], StatusCode::OK);
    }

    /**
     * Exibir uma listagem por filtro
     */
    public function search($nomeLinguagem)
    {
        $filter = $nomeLinguagem;
        
        $conditions = [];
        
        if ($filter != null) {
            $conditions[] = ['nome', 'like', "%{$filter}%"];
        }

        $data = $this->linguagemProgramacao::where($conditions)->get();

        return response()->json(['results' => $data], StatusCode::OK);
    }

}
