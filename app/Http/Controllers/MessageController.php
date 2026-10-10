<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Dibuat dengan: php artisan make:controller MessageController
 */
class MessageController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate(
            [
                'name'    => ['required', 'string', 'max:100'],
                'email'   => ['required', 'email', 'max:150'],
                'message' => ['required', 'string', 'min:10', 'max:1000'],
            ],
            [
                'required' => ':attribute wajib diisi.',
                'email'    => 'Format email tidak valid.',
                'min'      => ':attribute minimal :min karakter.',
                'max'      => ':attribute maksimal :max karakter.',
            ],
            [
                'name'    => 'Nama',
                'email'   => 'Email',
                'message' => 'Pesan',
            ],
        );

        Message::create($validated);

        return redirect()
            ->route('contact')
            ->with('success', 'Terima kasih! Pesan kamu sudah tersimpan.');
    }
}
