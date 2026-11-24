<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::query()
            ->withCount([
                'items',
                'items as available_items_count' => fn ($query) =>$query->where('status_buku', 'tersedia'),
            ])
            ->latest('id_buku')
            ->get();

        $kategoriList =$this->getKategoriOptions();

        return view('buku.index', compact('buku', 'kategoriList'));
    }

    public function create()
    {
        $kategoriList =$this->getKategoriOptions();

        return view('buku.create', compact('kategoriList'));
    }

    public function store(Request $request)
    {
        $validated =$request->validate([
            'judul_buku' => ['required', 'string', 'max:255'],
            'penulis_buku' => ['required', 'string', 'max:255'],
            'penerbit_buku' => ['nullable', 'string', 'max:255'],
            'tahun_terbit_buku' => ['nullable', 'integer', 'min:1000', 'max:2100'],
            'stok_buku' => ['nullable', 'integer', 'min:0'],
            'id_kategori' => ['nullable', 'integer'],
        ]);

        $validated['penerbit_buku'] =$validated['penerbit_buku'] ?? '-';
        $validated['tahun_terbit_buku'] =$validated['tahun_terbit_buku'] ?? (int) date('Y');
        $validated['stok_buku'] =$validated['stok_buku'] ?? 0;

        DB::transaction(function () use ($validated) {
            Buku::create($validated);
        });

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function show(Buku $buku)
    {
        $buku->load(['items' => fn ($query) => $query->orderByDesc('id_item_buku')]);$buku->loadCount([
            'items',
            'items as available_items_count' => fn ($query) =>$query->where('status_buku', 'tersedia'),
        ]);

        $kategoriList =$this->getKategoriOptions();

        return view('buku.show', compact('buku', 'kategoriList'));
    }

    public function edit(Buku $buku)
    {
        $kategoriList =$this->getKategoriOptions();

        return view('buku.edit', compact('buku', 'kategoriList'));
    }

    public function update(Request $request, Buku$buku)
    {
        $validated =$request->validate([
            'judul_buku' => ['required', 'string', 'max:255'],
            'penulis_buku' => ['required', 'string', 'max:255'],
            'penerbit_buku' => ['nullable', 'string', 'max:255'],
            'tahun_terbit_buku' => ['nullable', 'integer', 'min:1000', 'max:2100'],
            'stok_buku' => ['nullable', 'integer', 'min:0'],
            'id_kategori' => ['nullable', 'integer'],
        ]);

        $validated['penerbit_buku'] = $validated['penerbit_buku'] ?? '-';$validated['tahun_terbit_buku'] = $validated['tahun_terbit_buku'] ?? $buku->tahun_terbit_buku;
        $validated['stok_buku'] = $validated['stok_buku'] ?? $buku->stok_buku;

        $buku->update($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Detail buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Data buku beserta item bukunya berhasil dihapus.');
    }

    private function getKategoriOptions(): array
    {
        if (! Schema::hasTable('kategori_buku')) {
            return [
                ['id' => 1, 'nama' => 'Fiksi', 'deskripsi' => 'Buku cerita atau karya imajinatif.'],
                ['id' => 2, 'nama' => 'Non-Fiksi', 'deskripsi' => 'Buku yang berisi informasi, data, atau kejadian yang benar-benar terjadi dalam kehidupan nyata.'],
            ];
        }

        $rows = DB::table('kategori_buku')->get();$result = [];

        foreach ($rows as$row) {
            $arr = (array)$row;
            $id = $arr['id_kategori'] ?? $arr['id'] ?? null;
            $nama = $arr['nama_kategori'] ?? $arr['nama'] ?? ('Kategori #' . $id);$deskripsi = $arr['deskripsi'] ?? $arr['keterangan'] ?? 'Kategori buku perpustakaan.';

            if ($id !== null) {$result[] = [
                    'id' => (int) $id,
                    'nama' => (string) $nama,
                    'deskripsi' => (string) $deskripsi,
                ];
            }
        }

        return $result;
    }
}