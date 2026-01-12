<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Armamento;
use App\Models\Policial;
use App\Models\Cautela;
use Illuminate\Support\Facades\Auth; // Para pegar o ID do armeiro logado

class MovimentacaoController extends Controller
{
    // 1. Tela de Cautela (Formulário)
    public function create()
    {
        return view('movimentacao.create');
    }

    // 2. Processar a Saída (Lógica Pesada)
    public function store(Request $request)
    {
        // Validação básica
        $request->validate([
            'rg_policial' => 'required|string',
            'numero_serie' => 'required|string',
        ]);

        // A. Buscar o Policial pelo RG
        $policial = Policial::where('rg', $request->rg_policial)->first();
        if (!$policial) {
            return back()->withErrors(['rg_policial' => 'Policial não encontrado com este RG.']);
        }

        // B. Buscar a Arma pela Série
        $arma = Armamento::where('numero_serie', $request->numero_serie)->first();
        if (!$arma) {
            return back()->withErrors(['numero_serie' => 'Armamento não encontrado.']);
        }

        // C. Verificar se a arma está DISPONIVEL
        if ($arma->situacao !== 'DISPONIVEL') {
            return back()->withErrors(['numero_serie' => "Esta arma não está disponível. Situação atual: {$arma->situacao}"]);
        }

        // D. TUDO CERTO? Registrar a Cautela!
        // Como vamos alterar duas tabelas (cautela e armamento), é ideal ter certeza que ambas funcionam
        
        // 1. Cria o registro na tabela de cautelas
        Cautela::create([
            'policial_id' => $policial->id,
            'armamento_id' => $arma->id,
            'user_id' => 1, // IMPORTANTE: Por enquanto fixo 1 pq não temos login feito. Depois mudamos para Auth::id()
            'data_retirada' => now(),
            'devolvido' => false,
            'observacoes' => $request->observacoes
        ]);

        // 2. Atualiza o status da arma para EM_USO
        $arma->update(['situacao' => 'EM_USO']);

        return redirect()->route('armamentos.index')->with('sucesso', "Cautela realizada! Fuzil/Pistola entregue ao {$policial->posto_grad} {$policial->nome_guerra}.");
    }
    // 1. Tela de Cautela em Massa
    public function createBatch()
    {
        $policiais = Policial::all();
        return view('movimentacao.batch', compact('policiais'));
    }

    // 2. Processar Lote
    public function storeBatch(Request $request)
    {
        $request->validate([
            'rg_responsavel' => 'required|string',
            'tipo_movimento' => 'required|in:INSTRUCAO,MANUTENCAO',
            'series' => 'required|array', // Recebe uma lista de séries
            'series.*' => 'string',
        ]);

        // Busca o Responsável (Instrutor ou Armeiro Mecânico)
        $responsavel = Policial::where('rg', $request->rg_responsavel)->first();
        
        if (!$responsavel) {
            return back()->withErrors(['rg_responsavel' => 'Responsável não encontrado.']);
        }

        $sucessos = 0;
        $erros = [];

        // Loop para processar cada arma da lista
        foreach ($request->series as $serie) {
            $arma = Armamento::where('numero_serie', $serie)->first();

            // Verificações individuais
            if (!$arma) {
                $erros[] = "Série $serie: Não encontrada.";
                continue;
            }

            if ($arma->situacao !== 'DISPONIVEL') {
                $erros[] = "Série $serie: Indisponível (Status: {$arma->situacao}).";
                continue;
            }

            // Define o novo status baseado no tipo de movimento
            $novoStatus = ($request->tipo_movimento == 'MANUTENCAO') ? 'MANUTENCAO' : 'EM_USO';

            // Cria a Cautela
            Cautela::create([
                'policial_id' => $responsavel->id,
                'armamento_id' => $arma->id,
                'user_id' => 1, // Temporário (ID do armeiro logado)
                'data_retirada' => now(),
                'devolvido' => false,
                'observacoes' => "Movimentação em Massa: " . $request->tipo_movimento
            ]);

            // Atualiza a Arma
            $arma->update(['situacao' => $novoStatus]);
            $sucessos++;
        }

        // Retorna com relatório
        if (count($erros) > 0) {
            return redirect()->route('armamentos.index')
                ->with('alerta', "$sucessos armas processadas. Erros: " . implode(' | ', $erros));
        }

        return redirect()->route('armamentos.index')
            ->with('sucesso', "Operação de $request->tipo_movimento realizada com sucesso! $sucessos armas movimentadas.");
    }
}