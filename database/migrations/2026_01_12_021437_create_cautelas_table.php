<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('cautelas', function (Blueprint $table) {
        $table->id();
        
        // Quem está LEVANDO a arma (Policial)
        $table->foreignId('policial_id')->constrained('policiais');
        
        // Qual arma está sendo levada
        $table->foreignId('armamento_id')->constrained('armamentos');
        
        // Quem ENTREGOU a arma (O Armeiro logado no sistema)
        $table->foreignId('user_id')->constrained('users'); 
        
        $table->dateTime('data_retirada');
        $table->dateTime('data_devolucao')->nullable(); // Null = Ainda está na rua
        $table->boolean('devolvido')->default(false); // Flag rápida de status
        
        $table->text('observacoes')->nullable(); // Missão, posto, etc.
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cautelas');
    }
};
