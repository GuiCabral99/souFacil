<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $clients = Client::where('user_id', Auth::id())->get();
        return view('clients', compact('clients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email',
            'document' => 'required|string|max:20|unique:clients,document',
            'documentType' => 'required|string|in:cpf,cnpj',
        ]);

        $validated['user_id'] = Auth::id();
        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(Client $client): View
    {
        $this->authorizeClient($client);
        $client->load('sales');
        return view('client', compact('client'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $client = $this->findAuthorizedClient($id);

        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'document' => 'required|string|max:20|unique:clients,document,' . $client->id,
            'documentType' => 'required|string|in:cpf,cnpj',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(int $id): RedirectResponse
    {
        $client = $this->findAuthorizedClient($id);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Cliente excluído com sucesso!');
    }

    private function authorizeClient(Client $client): void
    {
        if ($client->user_id !== Auth::id()) {
            abort(403, 'Acesso não autorizado.');
        }
    }

    private function findAuthorizedClient(int $id): Client
    {
        $client = Client::findOrFail($id);
        $this->authorizeClient($client);
        return $client;
    }
}
