@php
    $links = [
        'home'    => 'Beranda',
        'about'   => 'Tentang',
        'contact' => 'Kontak',
    ];
@endphp

<header class="border-b bg-white">
    <nav class="mx-auto flex max-w-4xl items-center justify-between px-4 py-4">
        <a href="{{ route('home') }}" class="text-lg font-bold text-indigo-600">⚡ {{ config('app.name') }}</a>

        <ul class="flex gap-1 text-sm font-medium">
            @foreach ($links as $routeName => $label)
                <li>
                    <a href="{{ route($routeName) }}"
                       class="rounded-md px-3 py-2 {{ request()->routeIs($routeName) ? 'bg-indigo-50 text-indigo-700' : 'text-slate-600 hover:bg-slate-100' }}">
                        {{ $label }}
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</header>
