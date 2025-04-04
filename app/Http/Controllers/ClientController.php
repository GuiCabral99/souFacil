<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $clients = Client::where('user_id', $user->id)->get();
        return view('clients', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email',
            'document' => 'required|string|max:20|unique:clients,document',
            'documentType' => 'required|string|in:cpf,cnpj',
        ]);
        
        $client = new Client($validated);
        $client->user_id = Auth::id();
        $client->save();
    
        return redirect()->route('clients.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Client::where('user_id', Auth::id())->findOrFail($id);
    
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email,' . $client->id,
            'document' => 'required|string|max:20|unique:clients,document,' . $client->id,
            'documentType' => 'required|string|in:cpf,cnpj',
        ]);
    
        $client->update($validated);
        return redirect()->route('clients.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($client)
    {
        Client::where('user_id', Auth::id())->findOrFail($client)->delete();
        return redirect()->route('clients.index');
    }
}
