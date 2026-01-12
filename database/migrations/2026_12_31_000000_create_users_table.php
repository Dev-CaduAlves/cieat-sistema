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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // VÍNCULO: Se apagar o policial, apaga o login (cascade)
            $table->foreignId('policial_id')->constrained('policiais')->onDelete('cascade');

            $table->string('email')->unique(); // Vamos usar email ou CPF/RG como login? Por padrão é email.
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // NÍVEL DE ACESSO
            // 0: Operador (Pode ver), 1: Armeiro (Pode movimentar), 2: Admin (Pode tudo)
            $table->tinyInteger('nivel_acesso')->default(0);

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
