<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Setup Laravel') · {{ config('app.name') }}</title>

    {{-- Bonus: styling dengan Tailwind CDN (tanpa build step / Vite) --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-50 text-slate-800 antialiased">
    @include('partials.navbar')

    <main class="mx-auto max-w-4xl px-4 py-10">
        @yield('content')
    </main>

    <footer class="border-t bg-white py-6 text-center text-sm text-slate-500">
        Tugas Rutin 9 — Pemrograman Web · FMIPA UNIMED · Laravel {{ app()->version() }} · PHP {{ PHP_VERSION }}
    </footer>
</body>
</html>
