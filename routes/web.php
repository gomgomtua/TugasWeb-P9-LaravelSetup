<?php

use App\Http\Controllers\HelloController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
$mahasiswa = [
    'nama' => 'Gomgom tua antonius naibaho',
    'nim'  => '4253250008',
];

Route::get('/', fn () => view('welcome', [
    'name'    => $mahasiswa['nama'],
    'nim'     => $mahasiswa['nim'],
    'courses' => ['HTML', 'CSS', 'JavaScript', 'PHP & MySQL', 'Laravel'],
]))->name('home');

Route::get('/about', fn () => view('about', [
    'title' => 'Tentang Proyek',
    'stack' => [
        ['name' => 'Laravel',  'layer' => 'Framework',       'desc' => 'Framework PHP dengan arsitektur MVC.'],
        ['name' => 'Composer', 'layer' => 'Package manager', 'desc' => 'Mengelola dependency & autoloader PHP.'],
        ['name' => 'Artisan',  'layer' => 'CLI',             'desc' => 'Generator kode, migration, dan server development.'],
        ['name' => 'Blade',    'layer' => 'View (V)',        'desc' => 'Templating engine dengan auto-escape pada tanda kurung kurawal ganda.'],
        ['name' => 'Eloquent', 'layer' => 'Model (M)',       'desc' => 'ORM: tabel diakses sebagai object PHP.'],
        ['name' => 'MySQL',    'layer' => 'Database',        'desc' => 'Penyimpanan data, dikonfigurasi lewat .env.'],
    ],
]))->name('about');

Route::get('/contact', fn () => view('contact', [
    'contacts' => [
        ['label' => 'Kampus',      'value' => 'FMIPA — Universitas Negeri Medan'],
        ['label' => 'Mata kuliah', 'value' => 'Pemrograman Web'],
        ['label' => 'Email',       'value' => 'antoniusgomgom001@gmail.com'],
        ['label' => 'Instagram',   'value' => 'gomgomantonius'],
        ['label' => 'GitHub',      'value' => 'GTAN-gomgomtua'],
    ],
]))->name('contact');

// Proses form kontak -> Controller (C) -> Model (M)
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');

// Bonus: route parameter. whereAlpha() = constraint di level route (hanya huruf).
Route::get('/hello/{nama}', HelloController::class)
    ->whereAlpha('nama')
    ->name('hello');
