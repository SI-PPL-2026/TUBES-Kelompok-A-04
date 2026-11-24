<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'judul_buku',
        'penulis_buku',
        'penerbit_buku',
        'tahun_terbit_buku',
        'stok_buku',
        'id_kategori',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(ItemBuku::class, 'id_buku', 'id_buku');
    }
}