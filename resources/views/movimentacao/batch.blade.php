<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Movimentação em Lote</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-800 border-b pb-2">Movimentação em Massa (Instrução/Manutenção)</h1>

    <form action="{{ route('movimentacao.batch_store') }}" method="POST" id="formLote">
        @csrf

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-gray-700 font-bold">RG do Responsável</label>
                <select name="rg_responsavel" class="w-full border p-2 rounded bg-white" required>
                    <option value="">Selecione...</option>
                    @foreach ($policiais as $policial)
                    <option value="{{ $policial->rg }}"> {{ $policial->rg }} - {{ $policial->nome_escala }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label class="block text-gray-700 font-bold">Tipo de Operação</label>
                <select name="tipo_movimento" class="w-full border p-2 rounded bg-white">
                    <option value="INSTRUCAO">Instrução (Tiro/Campo)</option>
                    <option value="MANUTENCAO">Manutenção (Oficina)</option>
                </select>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded border border-gray-200 mb-6">
            <label class="block text-gray-700 font-bold mb-2">Adicionar Armamento (Bipe ou Digite + Enter)</label>
            <div class="flex gap-2">
                <input type="text" id="inputSerie" class="w-full border p-2 rounded font-mono uppercase" placeholder="Número de Série">
                <button type="button" onclick="adicionarArma()" class="bg-green-600 text-white px-4 rounded hover:bg-green-700">Adicionar</button>
            </div>
            <p class="text-xs text-gray-500 mt-1">Pressione ENTER para adicionar à lista abaixo.</p>
        </div>

        <div class="mb-6">
            <h3 class="font-bold text-gray-700 mb-2">Itens na Lista: <span id="contador">0</span></h3>
            <ul id="listaArmas" class="bg-white border rounded h-48 overflow-y-auto p-2 shadow-inner">
                </ul>
        </div>

        <div id="inputsOcultos"></div>

        <div class="flex justify-between">
            <a href="{{ route('armamentos.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded">Cancelar</a>
            <button type="submit" class="px-6 py-3 bg-blue-700 text-white font-bold rounded hover:bg-blue-800">
                PROCESSAR MOVIMENTAÇÃO
            </button>
        </div>
    </form>
</div>

<script>
    const inputSerie = document.getElementById('inputSerie');
    const listaArmas = document.getElementById('listaArmas');
    const inputsOcultos = document.getElementById('inputsOcultos');
    const contador = document.getElementById('contador');
    let totalArmas = 0;

    // Detecta o ENTER no input
    inputSerie.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Impede o envio do formulário
            adicionarArma();
        }
    });

    function adicionarArma() {
        const serie = inputSerie.value.trim().toUpperCase();
        
        if (serie === '') return;

        // Verifica se já está na lista visualmente (validação simples)
        if (document.getElementById(`item-${serie}`)) {
            alert('Esta arma já está na lista!');
            inputSerie.value = '';
            return;
        }

        // 1. Adicionar na lista visual (HTML)
        const li = document.createElement('li');
        li.id = `item-${serie}`;
        li.className = 'flex justify-between items-center p-2 border-b hover:bg-gray-50';
        li.innerHTML = `
            <span class="font-mono font-bold text-gray-800">${serie}</span>
            <button type="button" onclick="removerArma('${serie}')" class="text-red-500 text-sm hover:underline">Remover</button>
        `;
        listaArmas.appendChild(li);

        // 2. Adicionar Input Oculto para o PHP ler (name="series[]")
        const inputHidden = document.createElement('input');
        inputHidden.type = 'hidden';
        inputHidden.name = 'series[]'; // O array mágico do Laravel
        inputHidden.value = serie;
        inputHidden.id = `input-${serie}`;
        inputsOcultos.appendChild(inputHidden);

        // 3. Limpar campo e focar
        inputSerie.value = '';
        inputSerie.focus();
        
        // Atualiza contador
        totalArmas++;
        contador.innerText = totalArmas;
        
        // Scroll para o final da lista
        listaArmas.scrollTop = listaArmas.scrollHeight;
    }

    function removerArma(serie) {
        // Remove da lista visual
        document.getElementById(`item-${serie}`).remove();
        // Remove do input oculto
        document.getElementById(`input-${serie}`).remove();
        
        totalArmas--;
        contador.innerText = totalArmas;
    }
</script>

</body>
</html>