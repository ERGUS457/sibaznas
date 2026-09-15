<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ARTHAWISE')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {font-family: 'Plus Jakarta Sans', sans-serif; background:#f8fafc; color:#1e293b;}
    </style>
</head>
<body class="h-full flex flex-col antialiased">
    <header class="flex items-center justify-between px-4 py-3 bg-white border-b border-slate-200">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo ARTHAWISE" class="w-8 h-8">
            <h1 class="text-base font-bold text-slate-900">ARTHAWISE</h1>
        </div>
    </header>
    <main class="flex-1 p-4 max-w-4xl mx-auto">
        @yield('content')
    </main>
    <footer class="text-center text-xs text-slate-400 py-4">
        ARTHAWISE &bull; Artha Wise Finance
    </footer>
</body>
</html>
