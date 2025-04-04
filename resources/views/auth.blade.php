<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-600/80 to-blue-800/80 flex items-center justify-center">

  <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">Login</h1>

    @if ($errors->any())
      <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
          <ul class="list-disc list-inside text-sm">
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

    <hr class="py-2" />

    <a href="{{route("register")}}" class="flex justify-center">Registrar</a>
  </div>

</body>
</html>
