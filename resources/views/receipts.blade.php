@extends('layouts.app')

@section('title', 'Recebimentos')

@section('children')
<div class="max-w-6xl mx-auto p-4 space-y-6">
    {{-- Título --}}
    <header class="flex items-center justify-between">
        <h1 class="text-3xl font-bold">Recebimentos</h1>
        <a href="/" class="text-blue-600 hover:underline">Dashboard</a>
    </header>

    {{-- Filtros --}}
    <section>
        <form method="GET" action="{{ route('sales.receipts') }}" class="flex flex-wrap gap-4 items-end">
            {{-- Cliente --}}
            <div>
                <label for="client_id" class="block text-sm font-medium mb-1">Cliente</label>
                <select name="client_id" id="client_id" class="border rounded p-2">
                    <option value="">Todos</option>
                    @foreach(auth()->user()->clients as $client)
                        <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->first_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Data --}}
            <div>
                <label for="date" class="block text-sm font-medium mb-1">Data</label>
                <input type="date" name="date" id="date" value="{{ old('date', request('date')) }}" class="border rounded p-2">
            </div>

            {{-- Botão filtrar --}}
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition">
                Filtrar
            </button>
        </form>
    </section>

    {{-- Lista de recebimentos --}}
    <section class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full table-auto divide-y divide-gray-200">
            <thead class="bg-gray-100 text-left text-sm text-gray-700">
                <tr>
                    <th class="px-4 py-3">Cliente</th>
                    <th class="px-4 py-3">Valor</th>
                    <th class="px-4 py-3">Data</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Ações</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-100">
                @forelse ($sales as $sale)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $sale->client->first_name }}</td>
                        <td class="px-4 py-2">R$ {{ number_format($sale->value, 2, ',', '.') }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($sale->date)->format('d/m/Y') }}</td>
                        <td class="px-4 py-2">
                            @if ($sale->received)
                                <span class="text-green-600 font-semibold flex items-center gap-1">
                                    ✔ Recebida
                                </span>
                            @else
                                <span class="text-yellow-600 font-semibold flex items-center gap-1">
                                    ⏳ Pendente
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-2">
                            @if (!$sale->received)
                                <form method="POST" action="{{ route('sales.markAsReceived', $sale->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded transition focus:outline-none">
                                        Marcar como recebida
                                    </button>
                                </form>
                            @else
                            <form method="POST" action="{{ route('sales.markAsNotReceived', $sale->id) }}">
                                @csrf
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition focus:outline-none">
                                    Marcar como recebida
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500">
                            Nenhuma venda encontrada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>
</div>
@endsection
