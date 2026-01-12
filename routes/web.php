<?php

use App\Http\Controllers\ArmamentoController; // Não esqueça de importar no topo
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovimentacaoController;

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

//Rotas do Controle de Cautela
// Rotas de Movimentação
Route::get('/cautela', [MovimentacaoController::class, 'create'])->name('movimentacao.create');
Route::post('/cautela', [MovimentacaoController::class, 'store'])->name('movimentacao.store');
// Rotas de Movimentação em Massa
Route::get('/movimentacao/lote', [MovimentacaoController::class, 'createBatch'])->name('movimentacao.batch_create');
Route::post('/movimentacao/lote', [MovimentacaoController::class, 'storeBatch'])->name('movimentacao.batch_store');