<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu'; // Pastikan ini sesuai dengan nama tabel
    protected $fillable = ['nama_menu', 'harga', 'deskripsi', 'gambar']; // Kolom yang dapat diisi
}
