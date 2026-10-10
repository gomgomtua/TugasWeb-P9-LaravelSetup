# TugasWeb-P9-LaravelSetup

**Tugas Rutin 9 — Setup Laravel** · 3KOM40115 Pemrograman Web · FMIPA UNIMED · Semester Ganjil 2026/2027

| | |
|---|---|
| Nama | _(Gomgom tua antonius naibaho)_ |
| NIM | _(4253250008)_ |
| Repo | `TugasWeb-P9-LaravelSetup` |

Proyek Laravel pertama: instalasi lewat Composer, koneksi MySQL via `.env`, tiga route custom
(`/`, `/about`, `/contact`) yang me-return Blade view dengan data dinamis, serta contoh pemakaian
`make:controller` dan `make:model -m`.

---

## 1. Checklist requirement

| # | Requirement | Bukti di repo |
|---|---|---|
| 1 | Install Composer & buat project (`composer create-project`) | Bagian 3 · `composer.json` · `composer.lock` |
| 2 | Buat DB di phpMyAdmin & konfigurasi `.env` (mysql) | Bagian 4 · `.env.example` · `docs/screenshots/03-phpmyadmin-tabel.png` |
| 3 | `artisan serve` berjalan + screenshot welcome page | `docs/screenshots/01-welcome-default.png`, `02-welcome-custom.png` |
| 4 | 3 route custom (`/`, `/about`, `/contact`) return Blade view | `routes/web.php` |
| 5 | View menampilkan data dinamis (array dari route) | `welcome`, `about`, `contact` (`resources/views/`) |
| 6 | `make:controller` & `make:model -m` minimal 1× | `HelloController`, `MessageController`, `Message` + migration `messages` |
| 7 | README: langkah install + penjelasan struktur folder | File ini (bagian 3, 5, 6) |
| 8 | Nama repo `TugasWeb-P9-LaravelSetup` | 
| 9 | Bonus: Tailwind CDN + route parameter `/hello/{nama}` | `layouts/app.blade.php`, `HelloController` |

### Bukti screenshot

![Welcome bawaan Laravel](docs/screenshots/01-welcome-default.png)
![Welcome custom](docs/screenshots/02-welcome-custom.png)
![Tabel di phpMyAdmin](docs/screenshots/03-phpmyadmin-tabel.png)

---

## 2. Prasyarat

| Tool | Versi | Cek |
|---|---|---|
| PHP | ≥ 8.2 (Laravel 13 membutuhkan ≥ 8.3) | `php -v` |
| Composer | 2.x | `composer -V` |
| MySQL | Laragon / XAMPP | aktifkan modul MySQL |
| Git | — | `git --version` |

---

## 3. Langkah instalasi

### A. Menjalankan repo ini (clone)

```bash
git clone https://github.com/<username>/TugasWeb-P9-LaravelSetup.git
cd TugasWeb-P9-LaravelSetup

composer install                 # unduh dependency sesuai composer.lock → folder vendor/
cp .env.example .env             # Windows CMD: copy .env.example .env
php artisan key:generate         # isi APP_KEY
```

Buat database (bagian 4), lalu:

```bash
php artisan migrate              # buat tabel users, sessions, cache, jobs, messages
php artisan serve                # → http://127.0.0.1:8000
```

### B. Jejak pembuatan proyek dari nol

```bash
# 1. Prasyarat
php -v && composer -V

# 2. Buat project Laravel
composer create-project laravel/laravel TugasWeb-P9-LaravelSetup
cd TugasWeb-P9-LaravelSetup

# 3. Jalankan server pertama kali → screenshot welcome bawaan
php artisan serve

# 4. Generate kode dengan Artisan
php artisan make:controller HelloController --invokable
php artisan make:controller MessageController
php artisan make:model Message -m        # model + migration sekaligus

# 5. Terapkan konfigurasi .env (bagian 4) lalu migrate
php artisan migrate
```

---

## 4. Konfigurasi database (phpMyAdmin + `.env`)

1. Pastikan **MySQL** di Laragon/XAMPP sudah _Start_.
2. Buka `http://localhost/phpmyadmin` → **New** → nama `setup_laravel_db`, collation `utf8mb4_unicode_ci` → **Create**.
3. Edit `.env` (file ini **tidak** di-commit — sudah ada di `.gitignore`):

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=setup_laravel_db
DB_USERNAME=root
DB_PASSWORD=
```

4. `php artisan migrate` → tabel muncul di phpMyAdmin (screenshot sebagai bukti).

> Jangan pernah meng-commit `.env`: isinya password database dan `APP_KEY`.
> Yang di-commit adalah `.env.example` (template tanpa rahasia).

---

## 5. Daftar route

| Method | URI | Handler | Nama | Keterangan |
|---|---|---|---|---|
| GET | `/` | closure → view `welcome` | `home` | Data: `name`, `nim`, `courses[]` |
| GET | `/about` | closure → view `about` | `about` | Data: `title`, `stack[]` |
| GET | `/contact` | closure → view `contact` | `contact` | Data: `contacts[]` + form |
| POST | `/contact` | `MessageController@store` | `contact.store` | Validasi + simpan ke tabel `messages` |
| GET | `/hello/{nama}` | `HelloController` (invokable) | `hello` | Bonus; `nama` hanya huruf (`whereAlpha`) |

Verifikasi: `php artisan route:list`

---

## 6. Struktur folder & perannya

```
TugasWeb-P9-LaravelSetup/
├── app/
│   ├── Http/Controllers/       # C — HelloController, MessageController
│   └── Models/                 # M — Message (Eloquent)
├── bootstrap/                  # booting framework (app.php) — jarang disentuh
├── config/                     # file konfigurasi; nilainya dibaca dari .env
├── database/
│   └── migrations/             # versi skema DB ("Git untuk database")
├── public/                     # satu-satunya folder yang boleh diakses browser (index.php)
├── resources/
│   └── views/                  # V — Blade: layouts/, partials/, welcome, about, contact, hello
├── routes/
│   └── web.php                 # peta URL → view/controller
├── storage/                    # log, cache, upload (tidak di-commit)
├── tests/Feature/              # PageTest — pengujian otomatis
├── vendor/                     # dependency Composer (tidak di-commit)
├── .env                        # rahasia lokal (tidak di-commit)
├── .env.example                # template .env (di-commit)
├── artisan                     # CLI Laravel
├── composer.json / .lock       # daftar & versi pasti dependency (lock WAJIB di-commit)
└── README.md
```

### Alur MVC pada proyek ini

```
Request GET /contact ──► routes/web.php ──► view('contact', ['contacts' => [...]])   (halaman + data array)
Request POST /contact ─► routes/web.php ──► MessageController@store                  (C: validasi)
                                              └─► Message::create($validated)         (M: simpan ke DB)
                                              └─► redirect()->route('contact')        (V: tampil flash sukses)
```

- **Route** hanya memetakan URL; tidak ada query/logika bisnis di route maupun di view.
- **Controller** memvalidasi input lalu mendelegasikan penyimpanan ke **Model**.
- **View** hanya menampilkan data; semua output memakai `{{ }}` (auto-escape → aman dari XSS).
- Form memakai `@csrf`; Model memakai `$fillable` (mass-assignment protection).

---

## 7. Perintah Artisan yang dipakai

| Perintah | Fungsi |
|---|---|
| `php artisan serve` | Server development di `127.0.0.1:8000` |
| `php artisan make:controller HelloController --invokable` | Controller single-action |
| `php artisan make:controller MessageController` | Controller biasa |
| `php artisan make:model Message -m` | Model **+** migration |
| `php artisan migrate` | Terapkan migration ke database |
| `php artisan route:list` | Lihat semua route |
| `php artisan test` | Jalankan pengujian |

## 8. Pengujian otomatis

```bash
php artisan test
```

`phpunit.xml` memakai SQLite in-memory (`:memory:`), jadi database MySQL kamu tidak tersentuh.
Pastikan ekstensi `pdo_sqlite` aktif di PHP.

## 9. Catatan keamanan

- `.env` tidak di-commit; `APP_DEBUG=false` di produksi.
- Output Blade memakai `{{ }}`, bukan `{!! !!}`.
- Input form divalidasi di server + `@csrf`.
- Route parameter dibatasi constraint (`whereAlpha`).
