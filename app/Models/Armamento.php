<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Armamento extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_armamento',
        'fabricante',
        'modelo',
        'calibre',
        'numero_serie',
        'situacao',
        'observacoes'
    ];
}