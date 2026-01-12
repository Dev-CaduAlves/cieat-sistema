<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Armamento; // Importante: avisar onde está o Model
use Illuminate\Http\RedirectResponse;

class ArmamentoController extends Controller
{
    public function index()
    {
        // 1. Vai no banco e pega tudo
        $armamentos = Armamento::all(); 
        
        // 2. Retorna a visualização (View) enviando os dados junto
        // 'armamentos.index' significa: pasta armamentos, arquivo index.blade.php
        return view('armamentos.index', compact('armamentos'));
    }

    public function create()
    {
        return view('armamentos.create');
    }

    // 2. Recebe os dados do formulário e salva
    public function store(Request $request): RedirectResponse
    {
        // Validação: Garante que os dados estão certos antes de salvar
        $dados = $request->validate([
            'tipo_armamento' => 'required|string',
            'modelo' => 'required|string',
            'fabricante' => 'required|string',
            'numero_serie' => 'required|unique:armamentos,numero_serie', // Único na tabela!
            'calibre' => 'required|string',
            'situacao' => 'required',
            'observacoes' => 'nullable|string'
        ]);

        // Cria no banco (Mágica do Eloquent)
        Armamento::create($dados);

        // Redireciona para a lista com mensagem de sucesso
        return redirect()->route('armamentos.index')->with('sucesso', 'Armamento cadastrado com sucesso!');
    }
    // 3. Mostra o formulário de edição com os dados carregados
    // O Laravel já acha o armamento pelo ID na rota automaticamente
    public function edit(Armamento $armamento)
    {
        return view('armamentos.edit', compact('armamento'));
    }

    // 4. Atualiza os dados no banco
    public function update(Request $request, Armamento $armamento): RedirectResponse
    {
        $dados = $request->validate([
            'tipo_armamento' => 'required|string',
            'modelo' => 'required|string',
            'fabricante' => 'required|string',
            // O trecho depois da virgula diz: "Verifique se é único, mas ignore o ID atual"
            'numero_serie' => 'required|unique:armamentos,numero_serie,' . $armamento->id, 
            'calibre' => 'required|string',
            'situacao' => 'required',
            'observacoes' => 'nullable|string'
        ]);

        $armamento->update($dados);

        return redirect()->route('armamentos.index')->with('sucesso', 'Armamento atualizado com sucesso!');
    }

    // 5. Apaga o registro
    public function destroy(Armamento $armamento): RedirectResponse
    {
        $armamento->delete();
        return redirect()->route('armamentos.index')->with('sucesso', 'Armamento baixado/excluído!');
    }
}