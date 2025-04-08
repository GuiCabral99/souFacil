@extends('layouts.app')

@section('title', 'Editar Conta')

@section('children')
<header class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-10">
    <h1 class="text-xl font-bold">Editar Conta</h1>
    <a href="{{ route('clients.index') }}" class="text-blue-600 hover:underline">← Voltar para Home</a>
</header>

<main class="max-w-2xl mx-auto mt-8 bg-white p-6 rounded shadow space-y-8">

    {{-- Atualizar Dados --}}
    <section>
        <h2 class="text-lg font-semibold mb-4">Seus Dados</h2>
        <form method="POST" action="{{ route('user.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="first_name" class="block text-sm font-medium">Nome</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}"
                    class="w-full border p-2 rounded" required>
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                    class="w-full border p-2 rounded" required>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Atualizar Dados
            </button>
        </form>
    </section>

    {{-- Atualizar Senha --}}
    <section>
      <h2 class="text-lg font-semibold mb-4">Alterar Senha</h2>
      
      @if (session('status'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
              {{ session('status') }}
          </div>
      @endif
      
      @if ($errors->any())
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      
      <form method="POST" action="{{ route('user.password.update') }}" class="space-y-4">
          @csrf
          @method('PUT')
  
          <div>
              <label for="current_password" class="block text-sm font-medium">Senha Atual</label>
              <input type="password" id="current_password" name="current_password"
                     class="w-full border p-2 rounded @error('current_password') border-red-500 @enderror" required>
              @error('current_password')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
          </div>
  
          <div>
              <label for="password" class="block text-sm font-medium">Nova Senha</label>
              <input type="password" id="password" name="password"
                     class="w-full border p-2 rounded @error('password') border-red-500 @enderror" required>
              @error('password')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
          </div>
  
          <div>
              <label for="password_confirmation" class="block text-sm font-medium">Confirmar Nova Senha</label>
              <input type="password" id="password_confirmation" name="password_confirmation"
                     class="w-full border p-2 rounded" required>
          </div>
  
          <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
              Alterar Senha
          </button>
      </form>
  </section>

    {{-- Excluir Conta --}}
    <section>
        <h2 class="text-lg font-semibold mb-4 text-red-600">Excluir Conta</h2>
        <form method="POST" action="{{ route('user.destroy') }}"
            onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não poderá ser desfeita.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                Excluir Conta
            </button>
        </form>
    </section>

</main>
@endsection
