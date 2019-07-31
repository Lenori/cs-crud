<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'produto',
        'qtd',
        'valor',
        'cliente',
        'cep',
        'uf',
        'municipio',
        'bairro',
        'rua',
        'numero',
        'despachante',
        'status'
    ];
}
