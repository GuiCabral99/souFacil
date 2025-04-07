<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>SouFacil - @yield('title', 'Painel')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>

    @stack('styles')
    @yield('head')
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">

    @yield('children')

    @stack('scripts')
</body>
</html>
