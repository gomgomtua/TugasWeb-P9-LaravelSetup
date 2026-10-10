<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Dibuat dengan: php artisan make:model Message -m
 */
class Message extends Model
{
    // Mass-assignment protection: hanya kolom ini yang boleh diisi massal.
    protected $fillable = ['name', 'email', 'message'];
}
