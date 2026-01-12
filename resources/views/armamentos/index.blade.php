<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carga de Armamento - CIEAT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-6xl mx-auto bg-white shadow-md rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-800">Carga de Armamento - CIEAT</h1>
            <a href="{{ route('armamentos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Novo Armamento
            </a>
        </div>

        @if(session('sucesso'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('sucesso') }}
        </div>
        @endif
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-3 border-b">Tipo</th>
                    <th class="p-3 border-b">Modelo</th>
                    <th class="p-3 border-b">Fabricante</th>
                    <th class="p-3 border-b">Série</th>
                    <th class="p-3 border-b">Calibre</th>
                    <th class="p-3 border-b">Situação</th>
                    <th class="p-3 border-b">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($armamentos as $arma)
                <tr class="hover:bg-gray-50">
                    <td class="p-3 border-b">{{ $arma->tipo_armamento }}</td>
                    <td class="p-3 border-b">{{ $arma->modelo }}</td>
                    <td class="p-3 border-b">{{ $arma->fabricante }}</td>
                    <td class="p-3 border-b font-mono font-bold">{{ $arma->numero_serie }}</td>
                    <td class="p-3 border-b">{{ $arma->calibre }}</td>
                    <td class="p-3 border-b">
                        <span class="px-2 py-1 rounded text-xs text-white 
                                {{ $arma->situacao == 'DISPONIVEL' ? 'bg-green-500' : 'bg-red-500' }}">
                            {{ $arma->situacao }}
                        </span>
                    </td>
                    <td class="p-3 border-b flex gap-2">
                        <a href="{{ route('armamentos.edit', $arma->id) }}" class="text-blue-600 hover:underline">Editar</a>

                        <form action="{{ route('armamentos.destroy', $arma->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta arma?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @if($armamentos->isEmpty())
        <p class="text-center text-gray-500 mt-4">Nenhum armamento cadastrado.</p>
        @endif
    </div>

</body>

</html>