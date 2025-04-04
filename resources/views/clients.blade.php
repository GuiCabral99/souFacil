{{-- <div>
    <h1>Dashboard</h1>

    <h2>Cadastrar Novo Cliente</h2>
    <form method="POST" action="{{ route('clients.store') }}">
        @csrf
        <label for="first_name">Nome</label>
        <input type="text" name="first_name" id="first_name" required>

        <label for="phone_number">Telefone</label>
        <input type="text" name="phone_number" id="phone_number" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="document">Documento</label>
        <input type="text" name="document" id="document" required>

        <label for="documentType">Tipo de Documento</label>
        <select name="documentType" id="documentType" required>
            <option value="cpf">CPF</option>
            <option value="cnpj">CNPJ</option>
        </select>

        <button type="submit">Cadastrar Cliente</button>
    </form>

    <hr>

    <h2>Clientes Cadastrados:</h2>
    @if($clients->isEmpty())
        <p>Nenhum cliente cadastrado.</p>
    @else
        <div>
            @foreach($clients as $client)
            <div>
                <p>Nome: {{$client->first_name}}</p>
                <p>Telefone: {{$client->phone_number}}</p>
                <p>Email: {{$client->email}}</p>
                <p>Documento ({{$client->documentType}}): {{$client->document}}</p>
                <div>
                    <a href="{{ route('clients.edit', $client->id) }}">Editar</a>
                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div> --}}

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <main class="p-6 space-y-8">

        <header class="flex items-center justify-between">
            <h1 class="text-center text-4xl font-bold">Dashboard</h1>
            @if(Auth::check())
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 border border-gray-400 rounded-md text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            @endif
        </header>
        
        <section class="border-b bg-white shadow-md rounded p-4 space-y-4">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold">Lista de Clientes</h2>
                <button onclick="openCreateClientModal()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition-colors">
                    Cadastrar Novo Cliente
                </button>    
            </div>
            <hr>
            <div>
                @if($clients->isEmpty())
                    <p>Nenhum cliente cadastrado.</p>
                @else
                    <div class="flex flex-wrap gap-4">
                        @foreach($clients as $client)
                            <div class="border-b bg-white shadow-md rounded p-4 space-y-1">
                                <p class="text-lg"><strong>Nome:</strong> {{ $client->first_name }}</p>
                                <p class="text-lg"><strong>Email:</strong> {{ $client->email }}</p>
                                <p class="text-lg"><strong>Telefone:</strong> {{ $client->phone_number }}</p>
                                <p class="text-lg"><strong>Documento ({{$client->documentType}}):</strong> {{ $client->document }}</p>
                                <div class="flex items-center justify-evenly">
                                    <button onclick="openEditClientModal({{ $client }})" class="bg-blue-500 text-white px-3 py-1 rounded">Editar</button>

                                    <form action="{{ route('clients.destroy', $client->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>    
                @endif
            </div>
        </section>
    </main>


    {{-- create client modal --}}
    <div id="createClientModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-xl">
            <div class="flex justify-between items-center border-b pb-3">
                <h2 class="text-2xl font-semibold text-gray-800">Cadastrar Novo Cliente</h2>
                <button onclick="closeModal()" class="text-gray-600 hover:text-gray-900 text-xl">&times;</button>
            </div>
    
            <form method="POST" action="{{ route('clients.store') }}" class="space-y-4 mt-4">
                @csrf
    
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700">Nome</label>
                    <input type="text" name="first_name" id="first_name" required
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
    
                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Telefone</label>
                    <input type="text" name="phone_number" id="phone_number" required
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
    
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" required
                           class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
    
                <div class="flex items-center space-x-2">
                    <div class="w-full">
                        <label for="document" class="block text-sm font-medium text-gray-700">Documento</label>
                        <input type="text" name="document" id="document" required
                               class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
    
                    <div class="w-2/5">
                        <label for="documentType" class="block text-sm font-medium text-gray-700">Tipo de Documento</label>
                        <select name="documentType" id="documentType" required
                                class="mt-1 block w-full border border-gray-300 rounded-md p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="cpf">CPF</option>
                            <option value="cnpj">CNPJ</option>
                        </select>
                    </div>
                </div>
    
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition-colors">
                        Cadastrar Cliente
                    </button>
                    <button type="button" onclick="closeModal('createClientModal')" class="px-4 py-2 border border-gray-400 rounded-md text-gray-700 hover:bg-gray-100">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- edit client modal --}}
    <div id="editClientModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 justify-center items-center hidden">
        <div class="bg-white p-6 rounded shadow-lg">
            <h2 class="text-xl font-bold mb-4">Editar Cliente</h2>
            
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" id="client_id" name="id">

                <label class="block">Nome</label>
                <input type="text" id="first_name" name="first_name" class="w-full p-2 border rounded mb-2">

                <label class="block">Telefone</label>
                <input type="text" id="phone_number" name="phone_number" class="w-full p-2 border rounded mb-2">

                <label class="block">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded mb-2">

                <div class="flex space-x-2">
                    <div>
                        <label class="block">Documento</label>
                        <input type="text" id="document" name="document" class="w-full p-2 border rounded mb-2">
                    </div>
                    <div>
                        <label class="block">Tipo de Documento</label>
                        <select id="documentType" name="documentType" class="w-full p-2 border rounded mb-4">
                            <option value="cpf">CPF</option>
                            <option value="cnpj">CNPJ</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Salvar</button>
                    <button type="button" onclick="closeModal('editClientModal')" class="bg-gray-500 text-white px-4 py-2 rounded">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function openCreateClientModal() {
        document.getElementById('createClientModal').classList.add('flex');
        document.getElementById('createClientModal').classList.remove('hidden');
    }

    function openEditClientModal(client) {
        document.getElementById('editClientModal').classList.remove('hidden');
        document.getElementById('editClientModal').classList.add('flex');
        
        document.getElementById('client_id').value = client.id;
        document.getElementById('first_name').value = client.first_name;
        document.getElementById('phone_number').value = client.phone_number;
        document.getElementById('email').value = client.email;
        document.getElementById('document').value = client.document;
        document.getElementById('documentType').value = client.documentType;

        document.getElementById('editForm').action = `/clients/${client.id}`;
    }

    function closeModal(modal) {
        document.getElementById(modal).classList.add('hidden');
        document.getElementById(modal).classList.remove('flex');
    }
    </script>
</body>
</html>
