@extends('layouts.app')

@section('title', 'Dashboard')

@section('children')
<main class="bg-gray-100 min-h-screen">
    <div class="p-6 space-y-8">

        {{-- Header --}}
        <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h1 class="text-4xl font-bold text-center md:text-left">Dashboard</h1>

            @auth
            <div class="flex flex-wrap gap-4 items-center justify-center md:justify-end">
                <form method="POST" action="{{ route('user.destroy') }}" onsubmit="return confirm('Tem certeza que deseja excluir sua conta?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-4 py-2 border border-red-400 text-red-600 rounded-md hover:bg-red-100">
                        Excluir Conta
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-4 py-2 border border-gray-400 text-gray-700 rounded-md hover:bg-gray-100">
                        Logout
                    </button>
                </form>

                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">
                        Painel Admin
                    </a>
                @endif
            </div>
            @endauth
        </header>

        {{-- Lista de Clientes --}}
        <section class="bg-white shadow-md rounded p-6 space-y-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="text-2xl font-bold">Lista de Clientes</h2>
                <div class="flex flex-wrap gap-3">
                    <button 
                        onclick="openCreateClientModal()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md transition">
                        Cadastrar Novo Cliente
                    </button>

                    <a href="{{ route('sales.receipts') }}" class="text-sm bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                        Todos recebimentos
                    </a>
                </div>
            </div>

            <hr>

            @if($clients->isEmpty())
                <p class="text-gray-600">Nenhum cliente cadastrado.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($clients as $client)
                    <a href="{{ route('clients.show', $client->id) }}" class="border border-gray-300 hover:shadow-lg p-4 rounded-md transition">
                        <p class="text-lg"><strong>Nome:</strong> {{ $client->first_name }}</p>
                        <p class="text-lg"><strong>Email:</strong> {{ $client->email }}</p>
                        <p class="text-lg"><strong>Telefone:</strong> {{ $client->phone_number }}</p>
                        <p class="text-lg"><strong>Documento ({{ $client->documentType }}):</strong> {{ $client->document }}</p>
                    </a>
                    @endforeach
                </div>
            @endif
        </section>

    </div>

    {{-- Modais --}}
    @include('components.modals.createClient')
    @include('components.modals.editUser')

</main>

{{-- Scripts --}}
<script>
    function openCreateClientModal() {
        const modal = document.getElementById('createClientModal');
        modal.classList.add('flex');
        modal.classList.remove('hidden');
    }

    function openEditClientModal(client) {
        const modal = document.getElementById('editClientModal');
        modal.classList.add('flex');
        modal.classList.remove('hidden');

        document.getElementById('client_id').value = client.id;
        document.getElementById('first_name').value = client.first_name;
        document.getElementById('phone_number').value = client.phone_number;
        document.getElementById('email').value = client.email;
        document.getElementById('document').value = client.document;
        document.getElementById('documentType').value = client.documentType;

        document.getElementById('editForm').action = `/clients/${client.id}`;
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('flex');
        modal.classList.add('hidden');
    }
</script>
@endsection
