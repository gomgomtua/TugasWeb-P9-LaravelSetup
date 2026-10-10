@extends('layouts.app')

@section('title', 'Hello '.$nama)

@section('content')
    <section class="rounded-2xl bg-white p-10 text-center shadow-sm ring-1 ring-slate-200">
        <h1 class="mt-4 text-3xl font-bold">Hello, {{ $nama }}!</h1>
        <p class="mt-2 text-slate-500">
            Nilai <code class="rounded bg-slate-100 px-1.5 py-0.5 text-sm">{nama}</code> diambil dari URL
            (route parameter) lalu dikirim controller ke view ini.
        </p>
        <a href="{{ route('home') }}" class="mt-6 inline-block text-sm font-medium text-indigo-600 hover:underline">← Kembali ke beranda</a>
    </section>
@endsection
