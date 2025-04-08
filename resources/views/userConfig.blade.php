@extends('layouts.app')

@section('title', 'Editar Cliente')

@section('header')
    <h1 class="text-3xl font-bold">Editar Cliente</h1>
    <a href="{{ route('clients.index') }}" class="text-blue-600 hover:underline mt-4 md:mt-0">← Voltar para Lista</a>
@endsection

@section('children')
<main class="p-6 max-w-2xl mx-auto">
    <form method="POST" action="{{ route('clients.update', $client->id) }}" class="bg-white p-6 rounded shadow space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="first_name" class="block text-sm font-medium">Nome</label>
            <input type="text" name="first_name" id="first_name" class="w-full border p-2 rounded" value="{{ old('first_name', $client->first_name) }}" required>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" id="email" class="w-full border p-2 rounded" value="{{ old('email', $client->email) }}" required>
        </div>

        <div>
            <label for="phone_number" class="block text-sm font-medium">Telefone</label>
            <input type="text" name="phone_number" id="phone_number" class="w-full border p-2 rounded" value="{{ old('phone_number', $client->phone_number) }}" required>
        </div>

        <div>
            <label for="documentType" class="block text-sm font-medium">Tipo de Documento</label>
            <select name="documentType" id="documentType" class="w-full border p-2 rounded" required>
                <option value="cpf" {{ old('documentType', $client->documentType) === 'cpf' ? 'selected' : '' }}>CPF</option>
                <option value="cnpj" {{ old('documentType', $client->documentType) === 'cnpj' ? 'selected' : '' }}>CNPJ</option>
            </select>
        </div>

        <div>
            <label for="document" class="block text-sm font-medium">Documento</label>
            <input type="text" name="document" id="document" class="w-full border p-2 rounded" value="{{ old('document', $client->document) }}" required>
        </div>

        <div class="flex justify-between items-center pt-4">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Salvar Alterações
            </button>

            <form action="{{ route('clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este cliente?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Excluir Conta
                </button>
            </form>
        </div>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const phoneInput = document.getElementById('phone_number');
        const documentInput = document.getElementById('document');
        const documentType = document.getElementById('documentType');

        function applyPhoneMask(value) {
            value = value.replace(/\D/g, '');
            if (value.length > 10) {
                return value.replace(/(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
            } else {
                return value.replace(/(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
            }
        }

        function applyCpfMask(value) {
            return value.replace(/\D/g, '')
                        .replace(/(\d{3})(\d)/, '$1.$2')
                        .replace(/(\d{3})(\d)/, '$1.$2')
                        .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        }

        function applyCnpjMask(value) {
            return value.replace(/\D/g, '')
                        .replace(/^(\d{2})(\d)/, '$1.$2')
                        .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
                        .replace(/\.(\d{3})(\d)/, '.$1/$2')
                        .replace(/(\d{4})(\d)/, '$1-$2');
        }

        function handleDocumentMask() {
            let value = documentInput.value;
            if (documentType.value === 'cpf') {
                documentInput.value = applyCpfMask(value);
            } else {
                documentInput.value = applyCnpjMask(value);
            }
        }

        phoneInput.addEventListener('input', () => {
            phoneInput.value = applyPhoneMask(phoneInput.value);
        });

        documentInput.addEventListener('input', handleDocumentMask);
        documentType.addEventListener('change', handleDocumentMask);
    });
</script>

@if ($errors->any())
    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded max-w-2xl mx-auto">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection
