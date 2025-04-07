@extends('layouts.app')

@section('title', 'Usuários')

@section('children')
<main class="p-6 space-y-6">
    {{-- Cabeçalho --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h1 class="text-3xl font-bold">Usuários Cadastrados</h1>
        <a href="/" class="text-blue-600 hover:underline">Voltar ao Dashboard</a>
    </div>

    {{-- Mensagem de sucesso --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Tabela --}}
    <div class="overflow-auto">
        <table class="w-full table-auto bg-white shadow-md rounded">
            <thead class="bg-gray-200 text-left text-sm text-gray-700">
                <tr>
                    <th class="p-3">Nome</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Tipo</th>
                    <th class="p-3">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $user->first_name }}</td>
                    <td class="p-3">{{ $user->email }}</td>
                    <td class="p-3 capitalize">{{ $user->role }}</td>
                    <td class="p-3 space-x-2">
                        <button 
                            onclick="openEditUserModal({{ $user }})"
                            class="text-blue-600 hover:underline">
                            Editar
                        </button>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Deseja excluir este usuário?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Excluir</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        Nenhum usuário cadastrado.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

{{-- Modal de edição --}}
@include('components.modals.editUserAsAdmin')

{{-- Scripts --}}
<script>
    function openEditUserModal(user) {
        const modal = document.getElementById('editUserModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.getElementById('edit_first_name').value = user.first_name;
        document.getElementById('edit_email').value = user.email;
        document.getElementById('edit_role').value = user.role;

        document.getElementById('editUserForm').action = `/admin/users/${user.id}`;
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
