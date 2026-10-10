<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

/**
 * Single Action Controller.
 * Dibuat dengan: php artisan make:controller HelloController --invokable
 */
class HelloController extends Controller
{
    public function __invoke(string $nama): View
    {
        return view('hello', [
            'nama' => Str::title($nama),
        ]);
    }
}
