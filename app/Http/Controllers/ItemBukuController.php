<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\ItemBuku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ItemBukuController extends Controller
{
    public function store(Request $request, Buku$buku)
    {
        $validated =$request->validate([
            'kode_buku' => ['required', 'string', 'max:100', 'unique:item_buku,kode_buku'],
            'status_buku' => ['nullable', 'string', 'in:tersedia,dipinjam,rusak,hilang'],
            'tanggal_pembelian' => ['nullable', 'date'],
        ]);

        $validated['status_buku'] =$validated['status_buku'] ?? 'tersedia';

        DB::transaction(function () use ($buku,$validated) {
            $buku->items()->create($validated);
            $this->syncStokBuku($buku);
        });

        return back()->with('success', 'Item buku berhasil ditambahkan.');
    }

    public function update(Request $request, ItemBuku$itemBuku)
    {
        $validated =$request->validate([
            'kode_buku' => [
                'required',
                'string',
                'max:100',
                Rule::unique('item_buku', 'kode_buku')->ignore($itemBuku->id_item_buku, 'id_item_buku'),
            ],
            'status_buku' => ['required', 'string', 'in:tersedia,dipinjam,rusak,hilang'],
            'tanggal_pembelian' => ['nullable', 'date'],
        ]);

        DB::transaction(function () use ($itemBuku,$validated) {
            $itemBuku->update($validated);
            if ($itemBuku->buku) {
                $this->syncStokBuku($itemBuku->buku);
            }
        });

        return back()->with('success', 'Item buku berhasil diperbarui.');
    }

    public function destroy(ItemBuku $itemBuku)
    {
        $buku =$itemBuku->buku;

        DB::transaction(function () use ($itemBuku, $buku) {$itemBuku->delete();
            if ($buku) {
                $this->syncStokBuku($buku);
            }
        });

        return back()->with('success', 'Item buku berhasil dihapus.');
    }

    private function syncStokBuku(Buku $buku): void
    {
        $tersediaCount =$buku->items()->where('status_buku', 'tersedia')->count();
        $buku->update(['stok_buku' =>$tersediaCount]);
    }
}