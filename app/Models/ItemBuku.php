<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemBuku extends Model
{
    use HasFactory;

    protected $table = 'item_buku';

    protected $primaryKey = 'id_item_buku';

    protected $fillable = [
        'kode_buku',
        'status_buku',
        'tanggal_pembelian',
        'id_buku',
    ];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }
}