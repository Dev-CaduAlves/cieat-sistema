<?php

use App\Http\Controllers\ArmamentoController; // Não esqueça de importar no topo
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de Armamentos
Route::get('/armamentos', [ArmamentoController::class, 'index'])->name('armamentos.index');
Route::get('/armamentos/novo', [ArmamentoController::class, 'create'])->name('armamentos.create'); // Tela
Route::post('/armamentos', [ArmamentoController::class, 'store'])->name('armamentos.store'); // Ação de salvar
Route::get('/armamentos/{armamento}/editar', [ArmamentoController::class, 'edit'])->name('armamentos.edit');
Route::put('/armamentos/{armamento}', [ArmamentoController::class, 'update'])->name('armamentos.update');
Route::delete('/armamentos/{armamento}', [ArmamentoController::class, 'destroy'])->name('armamentos.destroy');