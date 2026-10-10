@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="rounded-2xl bg-white p-8 shadow-sm ring-1 ring-slate-200">
        <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">Pemrograman Web · Tugas Rutin 9</p>

        <h1 class="mt-2 text-3xl font-bold">Halo, {{ $name }}</h1>
        <p class="mt-1 text-slate-500">NIM {{ $nim }}</p>

        <p class="mt-6 text-slate-600">
            Ini halaman pertama proyek Laravel saya. Data di halaman ini dikirim dari
            <code class="rounded bg-slate-100 px-1.5 py-0.5 text-sm">routes/web.php</code> ke Blade view.
        </p>

        <h2 class="mt-8 text-lg font-semibold">Materi yang sudah dipelajari</h2>
        <ul class="mt-3 grid gap-2 sm:grid-cols-2">
            @forelse ($courses as $course)
                <li class="flex items-center gap-3 rounded-lg border border-slate-200 px-4 py-3">
                    <span class="flex h-7 w-7 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-700">
                        {{ $loop->iteration }}
                    </span>
                    {{ $course }}
                </li>
            @empty
                <li class="text-slate-500">Belum ada data.</li>
            @endforelse
        </ul>

        <div class="mt-8 flex flex-wrap gap-3 text-sm">
            <a href="{{ route('about') }}" class="rounded-lg bg-indigo-600 px-4 py-2 font-medium text-white hover:bg-indigo-700">Tentang proyek</a>
            <a href="{{ route('hello', ['nama' => 'laravel']) }}" class="rounded-lg border border-slate-300 px-4 py-2 font-medium hover:bg-slate-100">Coba /hello/laravel</a>
        </div>
    </section>
@endsection
