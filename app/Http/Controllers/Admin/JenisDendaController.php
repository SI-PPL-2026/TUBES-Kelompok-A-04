<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisDenda;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JenisDendaController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->string('q')->trim();

        $jenisDenda = JenisDenda::query()
            ->withCount('denda')
            ->when($q->isNotEmpty(), function ($query) use ($q) {
                $query->where('nama_denda', 'like', "%{$q}%")
                      ->orWhere('keterangan_denda', 'like', "%{$q}%");
            })
            ->orderByDesc('id_jenis_denda')
            ->paginate(10)
            ->withQueryString();

        return view('admin.jenis-denda.index', compact('jenisDenda'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_denda'       => ['required', 'string', 'max:255'],
            'nominal_denda'    => ['required', 'integer', 'min:1'],
            'keterangan_denda' => ['nullable', 'string'],
        ]);

        JenisDenda::create($validated);

        return redirect()
            ->route('admin.jenis-denda.index')
            ->with('success', 'Jenis denda berhasil ditambahkan.');
    }

    public function update(Request $request, JenisDenda $jenisDenda): RedirectResponse
    {
        $validated = $request->validate([
            'nama_denda'       => ['required', 'string', 'max:255'],
            'nominal_denda'    => ['required', 'integer', 'min:1'],
            'keterangan_denda' => ['nullable', 'string'],
        ]);

        $jenisDenda->update($validated);

        return redirect()
            ->route('admin.jenis-denda.index')
            ->with('success', 'Jenis denda berhasil diperbarui.');
    }

    public function destroy(JenisDenda $jenisDenda): RedirectResponse
    {
        if ($jenisDenda->denda()->exists()) {
            return redirect()
                ->route('admin.jenis-denda.index')
                ->with('error', 'Jenis denda tidak dapat dihapus karena sedang digunakan pada data transaksi.');
        }

        $jenisDenda->delete();

        return redirect()
            ->route('admin.jenis-denda.index')
            ->with('success', 'Jenis denda berhasil dihapus.');
    }
}