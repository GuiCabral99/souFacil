@extends('layouts.app')

@section('title', 'Login')

@section('children')
<main class="min-h-screen bg-gradient-to-br from-blue-600/80 to-blue-800/80 flex items-center justify-center">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8 space-y-6">
        <h1 class="text-3xl font-bold text-center text-gray-800">Login</h1>

        @if ($errors->any())
            <div class="p-4 bg-red-100 border border-red-400 text-red-700 rounded text-sm space-y-1">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                       class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input type="password" name="password" id="password" required
                       class="mt-1 w-full border border-gray-300 rounded-md px-4 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md transition-colors">
                    Entrar
                </button>
            </div>
        </form>

        <hr />

        <div class="text-center">
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Registrar</a>
        </div>
    </div>
</main>
@endsection
