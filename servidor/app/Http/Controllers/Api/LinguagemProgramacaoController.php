<?php

namespace App\Http\Controllers\Api;

use App\Repositories\LinguagemProgramacaoRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinguagemProgramacaoController extends Controller
{

    public function __construct(LinguagemProgramacaoRepository $linguagemProgramacaoRepository, Request $request)
    {
        $this->linguagemProgramacaoRepository = $linguagemProgramacaoRepository;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->linguagemProgramacaoRepository->listar();
    }

    public function search($nomeLinguagem = null)
    {
        return $this->linguagemProgramacaoRepository->search($nomeLinguagem);
    }

}
