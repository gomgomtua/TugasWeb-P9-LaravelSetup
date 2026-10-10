@extends('layouts.app')

@section('title', $title)

@section('content')
    <h1 class="text-3xl font-bold">{{ $title }}</h1>
    <p class="mt-2 text-slate-600">
        Teknologi yang dipakai pada proyek ini dan posisinya dalam arsitektur MVC.
    </p>

    <div class="mt-8 overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-100 text-xs uppercase tracking-wide text-slate-500">
                <tr>
                    <th class="px-4 py-3">Teknologi</th>
                    <th class="px-4 py-3">Peran</th>
                    <th class="px-4 py-3">Keterangan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach ($stack as $item)
                    <tr>
                        <td class="px-4 py-3 font-semibold">{{ $item['name'] }}</td>
                        <td class="px-4 py-3">
                            <span class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700">{{ $item['layer'] }}</span>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $item['desc'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
