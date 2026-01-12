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
    Schema::create('armamentos', function (Blueprint $table) {
        $table->id();
        
        // Dados de Identificação
        $table->string('tipo_armamento'); // Ex: PISTOLA, FUZIL, ESPINGARDA
        $table->string('fabricante');     // Ex: TAURUS, IMBEL, COLT
        $table->string('modelo');         // Ex: PT92, MD97, M4
        $table->string('calibre');        // Ex: 9mm, 5.56, .40, 7.62
        $table->string('numero_serie')->unique(); // O dado mais crítico
        
        // Estado de Conservação/Carga
        // DISPONIVEL: No paiol pronta para uso
        // EM_USO: Cautelada (instrução ou serviço)
        // MANUTENCAO: Na oficina (indisponível)
        // INSERVIVEL: Aguardando descarga
        $table->string('situacao')->default('DISPONIVEL'); 
        
        $table->text('observacoes')->nullable(); // Para anotar "coronha riscada", etc.
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armamentos');
    }
};
