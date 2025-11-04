<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

     protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'quantidade',
        'quantidade_minima'
    ];

     public function movimentacao()
    {
        return $this->hasOne(Movimentacao::class);
    }
}
