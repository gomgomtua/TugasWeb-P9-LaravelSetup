@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
    <h1 class="text-3xl font-bold">Kontak</h1>

    <dl class="mt-6 grid gap-4 sm:grid-cols-3">
        @foreach ($contacts as $contact)
            <div class="rounded-xl bg-white p-4 shadow-sm ring-1 ring-slate-200">
                <dt class="text-xs font-semibold uppercase tracking-wide text-slate-500">{{ $contact['label'] }}</dt>
                <dd class="mt-1 font-medium">{{ $contact['value'] }}</dd>
            </div>
        @endforeach
    </dl>

    <section class="mt-10 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
        <h2 class="text-lg font-semibold">Kirim pesan</h2>
        <p class="text-sm text-slate-500">Pesan disimpan ke tabel <code>messages</code> (Model <code>Message</code> + migration).</p>

        @if (session('success'))
            <div class="mt-4 rounded-lg border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-800" role="status">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('contact.store') }}" class="mt-4 space-y-4" novalidate>
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium">Nama</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}"
                       class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}"
                       class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="message" class="block text-sm font-medium">Pesan</label>
                <textarea id="message" name="message" rows="4"
                          class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2 font-medium text-white hover:bg-indigo-700">Kirim</button>
        </form>
    </section>
@endsection
