@extends('layouts.app')

@section('title', 'Todas as Vendas')

@section('children')
<main class="p-6 bg-gray-100 min-h-screen space-y-6">
    <header class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Todas as Vendas</h1>
        <a href="{{ route('clients.index') }}" class="text-blue-600 hover:underline">← Voltar para clientes</a>
    </header>

    @if ($sales->isEmpty())
        <p class="text-gray-600">Nenhuma venda encontrada.</p>
    @else
        <section class="flex flex-wrap gap-4">
            @foreach ($sales as $sale)
                <article class="bg-white p-4 rounded shadow">
                    <div class="mb-2 space-y-1 text-sm text-gray-700">
                        <p><strong>Cliente:</strong> {{ $sale->client->first_name }}</p>
                        <p><strong>Valor:</strong> R$ {{ number_format($sale->amount, 2, ',', '.') }}</p>
                        <p>
                            <strong>Recebida:</strong>
                            @if ($sale->received)
                                <span class="text-green-600 font-medium">✔ Sim</span>
                            @else
                                <span class="text-yellow-600 font-medium">⏳ Não</span>
                            @endif
                        </p>
                        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</p>
                    </div>
                    <div class="flex space-x-2 mt-4">
                        {{-- Botão Excluir --}}
                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta venda?')">
                            @csrf
                            @method('DELETE')
                            <button class="px-4 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition">
                                🗑 Excluir
                            </button>
                        </form>

                        {{-- Botão Editar --}}
                        <button 
                            onclick='openEditSaleModal(@json($sale))' 
                            class="px-4 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                            ✏️ Editar
                        </button>
                    </div>
                </article>
            @endforeach
        </section>
    @endif
</main>

{{-- Modal de edição --}}
@include('components.modals.editSale')

{{-- Script para abrir e fechar o modal --}}
<script>
    function openEditSaleModal(sale) {
        document.getElementById('editSaleModal').classList.remove('hidden');
        document.getElementById('editSaleModal').classList.add('flex');

        document.getElementById('edit_sale_id').value = sale.id;
        document.getElementById('edit_amount').value = sale.amount;
        document.getElementById('edit_date').value = sale.date;
        document.getElementById('edit_received').checked = sale.received;

        document.getElementById('editSaleForm').action = `/sales/${sale.id}`;
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('flex');
        document.getElementById(id).classList.add('hidden');
    }
</script>
@endsection
