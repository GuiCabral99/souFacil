@extends('layouts.app')

@section('title', 'Cliente')

@section('children')
<main class="bg-gray-100 min-h-screen p-6 space-y-8">

    <header class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <h1 class="text-3xl font-bold">Detalhes do Cliente</h1>

        <div class="flex gap-4 items-center">
            <button 
                onclick="openModal('create-sale-modal')" 
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                Nova Venda
            </button>

            <a href="{{ route('clients.index') }}" class="text-blue-600 hover:underline">
                ← Voltar para Lista
            </a>
        </div>
    </header>

    <section class="bg-white p-6 rounded shadow space-y-2">
        <h2 class="text-xl font-semibold mb-2">Informações Pessoais</h2>
        <p><strong>Nome:</strong> {{ $client->first_name }}</p>
        <p><strong>Email:</strong> {{ $client->email }}</p>
        <p><strong>Telefone:</strong> {{ $client->phone_number }}</p>
        <p><strong>Documento ({{ $client->documentType }}):</strong> {{ $client->document }}</p>

        <div class="flex gap-4 mt-4">
            <button 
                onclick="openEditClientModal({{ $client }})" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded cursor-pointer">
                Editar Cliente
            </button>

            <form method="POST" 
                  action="{{ route('clients.destroy', $client->id) }}" 
                  onsubmit="return confirm('Deseja excluir este cliente?')">
                @csrf
                @method('DELETE')
                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Excluir Cliente
                </button>
            </form>
        </div>
    </section>

    <section class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-semibold mb-4">Vendas Realizadas</h2>

        @if ($client->sales->isEmpty())
            <p>Este cliente ainda não possui vendas cadastradas.</p>
        @else
            <ul class="gap-4 flex flex-wrap">
                @foreach ($client->sales as $sale)
                    <button 
                        onclick='openEditSaleModal(@json($sale))'
                        class="border p-4 rounded text-start bg-white hover:bg-gray-100 transition">
                        <p><strong>ID:</strong> {{ $sale->id }}</p>
                        <p><strong>Valor:</strong> R$ {{ number_format($sale->amount, 2, ',', '.') }}</p>
                        <p><strong>Status:</strong> {{ $sale->received ? 'Recebido' : 'Pendente' }}</p>
                        <p><strong>Data:</strong> {{ $sale->date->format('d/m/Y') }}</p>
                    </button>
                @endforeach
            </ul>
        @endif
    </section>

</main>

@include('components.modals.editClient')
@include('components.modals.createSale')
@include('components.modals.editSale')


<script>
function openEditSaleModal(sale) {
    const modal = document.getElementById('editSaleModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');

    document.getElementById('edit_amount').value = sale.amount;
    const editDateInput = document.getElementById('edit_date');
    if (sale.date) {
        const [year, month, day] = sale.date.split('T')[0].split('-');
        editDateInput.value = `${year}-${month}-${day}`;
    }
    document.getElementById('edit_received').value = sale.received ? 1 : 0;
    document.getElementById('edit_client_id').value = sale.client_id;

    // Configura os actions dos formulários
    const saleId = sale.id;
    document.getElementById('editSaleForm').action = `/sales/${saleId}`;
    document.getElementById('deleteSaleForm').action = `/sales/${saleId}`;
}

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function openEditClientModal(client) {
        const modal = document.getElementById('editClientModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        document.getElementById('first_name').value = client.first_name;
        document.getElementById('email').value = client.email;
        document.getElementById('phone_number').value = client.phone_number;
        document.getElementById('document').value = client.document;
        document.getElementById('documentType').value = client.documentType;

        document.getElementById('editForm').action = `/clients/${client.id}`;
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
