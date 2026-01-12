<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Armamento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10">

    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Cadastrar Novo Armamento</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('armamentos.store') }}" method="POST">
            @csrf <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700">Tipo (Fuzil, Pistola...)</label>
                    <input type="text" name="tipo_armamento" class="w-full border p-2 rounded" required>
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700">Fabricante</label>
                    <input type="text" name="fabricante" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Modelo</label>
                    <input type="text" name="modelo" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Calibre</label>
                    <input type="text" name="calibre" class="w-full border p-2 rounded" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Número de Série</label>
                <input type="text" name="numero_serie" class="w-full border p-2 rounded bg-yellow-50" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Situação Inicial</label>
                <select name="situacao" class="w-full border p-2 rounded">
                    <option value="DISPONIVEL">Disponível (Paiol)</option>
                    <option value="MANUTENCAO">Manutenção (Oficina)</option>
                    <option value="INSERVIVEL">Inservível (Aguard. Descarga)</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Observações</label>
                <textarea name="observacoes" class="w-full border p-2 rounded"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('armamentos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded font-bold hover:bg-blue-700">Salvar Armamento</button>
            </div>
        </form>
    </div>

</body>
</html>