<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinguagemProgramacao extends Model
{
    protected $table = 'linguagem_programacao';

    protected $primaryKey = 'id_linguagem_programacao';

    protected $timestamp = true;

    protected $fillable = [
        'nome',
        'descricao',
        'imagem'
    ];

    /**
     * regras de validações
     * @return array
     */
    public function rules(){
        return [
            'nome' => 'riquired',
            'descricao' => 'required',
            'imagem' => 'image'
        ];
    }
}
