<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policial extends Model
{
    use HasFactory;
    
    // Define o nome da tabela explicitamente (boa prática)
    protected $table = 'policiais';

    // Lista branca de campos que podem ser salvos no banco
    protected $fillable = [
        'rg',
        'nome',
        'nome_escala',   // Campo novo que você adicionou
        'id_funcional',  // Campo novo que você adicionou
        'posto_grad',
        'unidade_lotacao',
        'ativo'
    ];

    // Relacionamento: Um policial POSSUI um Usuário (Opcional, nem todo PM tem senha)
    public function usuario()
    {
        return $this->hasOne(User::class);
    }
}
