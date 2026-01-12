<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Cautela</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800 h-screen flex justify-center items-center">

    <div class="bg-white p-8 rounded-lg shadow-xl w-full max-w-lg">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-2">Cautela de Armamento</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6 border-l-4 border-red-500">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('movimentacao.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">RG do Policial</label>
                <input type="text" name="rg_policial" placeholder="Digite o RG..." 
                       class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 text-lg" required autofocus>
                <p class="text-sm text-gray-500 mt-1">O Policial deve estar cadastrado previamente.</p>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Nº Série do Armamento</label>
                <input type="text" name="numero_serie" placeholder="Bipe ou digite a série..." 
                       class="w-full border-2 border-gray-300 p-3 rounded-lg focus:outline-none focus:border-blue-500 text-lg font-mono" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700">Observações (Opcional)</label>
                <textarea name="observacoes" class="w-full border p-2 rounded" placeholder="Ex: Serviço P2, Instrução..."></textarea>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                CONFIRMAR SAÍDA
            </button>
            
            <a href="{{ route('armamentos.index') }}" class="block text-center mt-4 text-gray-500 hover:underline">Voltar ao Menu</a>
        </form>
    </div>

</body>
</html>