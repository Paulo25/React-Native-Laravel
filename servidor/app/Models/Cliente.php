<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';

    protected $primaryKey = 'id_cliente';

    protected $timestamp = true;

    protected $fillable = [
        'nome',
        'cpf_cnpj',
        'image'
    ];

    /**
     * regra validação
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required',
            'cpf_cnpj' => 'required|unique:cliente',
            'image' => 'image'
        ];
    }

}
