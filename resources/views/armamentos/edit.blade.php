<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Armamento</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-2xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Editar Armamento: {{ $armamento->modelo }}</h2>

        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('armamentos.update', $armamento->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700">Tipo</label>
                    <input type="text" name="tipo_armamento" value="{{ $armamento->tipo_armamento }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Fabricante</label>
                    <input type="text" name="fabricante" value="{{ $armamento->fabricante }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Modelo</label>
                    <input type="text" name="modelo" value="{{ $armamento->modelo }}" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Calibre</label>
                    <input type="text" name="calibre" value="{{ $armamento->calibre }}" class="w-full border p-2 rounded" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold">Número de Série</label>
                <input type="text" name="numero_serie" value="{{ $armamento->numero_serie }}" class="w-full border p-2 rounded bg-yellow-50" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Situação</label>
                <select name="situacao" class="w-full border p-2 rounded">
                    <option value="DISPONIVEL" {{ $armamento->situacao == 'DISPONIVEL' ? 'selected' : '' }}>Disponível</option>
                    <option value="MANUTENCAO" {{ $armamento->situacao == 'MANUTENCAO' ? 'selected' : '' }}>Manutenção</option>
                    <option value="EM_USO" {{ $armamento->situacao == 'EM_USO' ? 'selected' : '' }}>Em Uso (Cautela)</option>
                    <option value="INSERVIVEL" {{ $armamento->situacao == 'INSERVIVEL' ? 'selected' : '' }}>Inservível</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Observações</label>
                <textarea name="observacoes" class="w-full border p-2 rounded">{{ $armamento->observacoes }}</textarea>
            </div>

            <div class="flex justify-end gap-2">
                <a href="{{ route('armamentos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded font-bold hover:bg-blue-700">Atualizar</button>
            </div>
        </form>
    </div>

</body>

</html>