<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SaleController extends Controller
{
    public function create(Request $request): View
    {
        $client = Client::findOrFail($request->get('client_id'));
        $this->authorizeClient($client);

        return view('sales.create', compact('client'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'received' => 'required|boolean',
        ]);

        $client = Client::findOrFail($validated['client_id']);
        $this->authorizeClient($client);

        $client->sales()->create([
            'amount' => $validated['amount'],
            'date' => $validated['date'],
            'received' => $validated['received'],
        ]);

        return redirect()->route('clients.show', $client->id)->with('success', 'Venda cadastrada!');
    }

    public function edit(Sale $sale): View
    {
        $this->authorizeClient($sale->client);
        return view('sales.edit', compact('sale'));
    }

    public function update(Request $request, Sale $sale): RedirectResponse
    {
        $this->authorizeClient($sale->client);

        $validated = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $sale->update($validated);

        return redirect()->route('clients.show', $sale->client_id)->with('success', 'Venda atualizada!');
    }

    public function destroy(Sale $sale): RedirectResponse
    {
        $this->authorizeClient($sale->client);
        $sale->delete();

        return back()->with('success', 'Venda excluída.');
    }

    public function clientSales(Client $client): View
    {
        $this->authorizeClient($client);
        $sales = $client->sales;
        return view('sales.client', compact('client', 'sales'));
    }

    public function toggleDelivered(Sale $sale): RedirectResponse
    {
        $this->authorizeClient($sale->client);

        $sale->delivered = !$sale->delivered;
        $sale->save();

        return back()->with('success', 'Status de entrega atualizado.');
    }

    public function receipts(Request $request): View
    {
        $query = Sale::with('client')
            ->whereHas('client', fn ($q) => $q->where('user_id', Auth::id()));

        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        $sales = $query->latest()->get();

        return view('receipts', compact('sales'));
    }

    public function markAsReceived(Sale $sale): RedirectResponse
    {
        $this->authorizeClient($sale->client);

        $sale->received = true;
        $sale->save();

        return redirect()->route('sales.receipts')->with('success', 'Venda marcada como recebida com sucesso!');
    }

    public function markAsNotReceived(Sale $sale): RedirectResponse
    {
        $this->authorizeClient($sale->client);

        $sale->received = false;
        $sale->save();

        return redirect()->route('sales.receipts')->with('success', 'Venda marcada como não recebida com sucesso!');
    }

    private function authorizeClient(Client $client): void
    {
        abort_if($client->user_id !== Auth::id(), 403, 'Acesso não autorizado.');
    }
}
