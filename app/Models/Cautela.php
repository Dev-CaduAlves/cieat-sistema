<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cautela extends Model
{
    use HasFactory;

    protected $fillable = [
        'policial_id', 'armamento_id', 'user_id', 
        'data_retirada', 'data_devolucao', 'devolvido', 'observacoes'
    ];

    // O policial que pegou
    public function policial() {
        return $this->belongsTo(Policial::class);
    }

    // A arma levada
    public function armamento() {
        return $this->belongsTo(Armamento::class);
    }

    // O armeiro que registrou
    public function armeiro() {
        return $this->belongsTo(User::class, 'user_id');
    }
}