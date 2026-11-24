<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImporSiswaRequest;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('q');

        $query = Siswa::query();

        if (Schema::hasTable('peminjaman')) {
            $query->withCount('peminjaman');
        }

        $siswa = $query
            ->when($search, function ($q, $term) {
                $q->where(function ($sub) use ($term) {
                    $sub->where('NISN_siswa', 'like', "%{$term}%")
                        ->orWhere('nama_siswa', 'like', "%{$term}%");
                });
            })
            ->orderBy('id_siswa', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('admin.siswa.index', compact('siswa', 'search'));
    }

    public function store(StoreSiswaRequest $request): RedirectResponse
    {
        Siswa::create($request->validated());

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa): RedirectResponse
    {
        $siswa->update($request->validated());

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        if (Schema::hasTable('peminjaman') && $siswa->peminjaman()->exists()) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', "Siswa {$siswa->nama_siswa} tidak dapat dihapus karena memiliki riwayat peminjaman.");
        }

        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function impor(ImporSiswaRequest $request): RedirectResponse
    {
        $path = $request->file('berkas')->getRealPath();
        $handle = fopen($path, 'r');

        if ($handle === false) {
            return back()->withErrors(['berkas' => 'Gagal membaca file CSV.']);
        }

        $barisKe = 0;
        $berhasil = 0;

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $barisKe++;

            if (count($row) < 4 || ($barisKe === 1 && strtolower(trim($row[0])) === 'nisn')) {
                continue;
            }

            $nisn         = trim($row[0]);
            $nama         = trim($row[1]);
            $jenisKelamin = trim($row[2]);
            $status       = trim($row[3]);

            if (
                $nisn === '' ||
                $nama === '' ||
                ! in_array($jenisKelamin, [Siswa::JENIS_KELAMIN_LAKI, Siswa::JENIS_KELAMIN_PEREMPUAN], true) ||
                ! in_array($status, [Siswa::STATUS_AKTIF, Siswa::STATUS_TIDAK_AKTIF], true)
            ) {
                continue;
            }

            Siswa::updateOrCreate(
                ['NISN_siswa' => $nisn],
                [
                    'nama_siswa'          => $nama,
                    'jenis_kelamin_siswa' => $jenisKelamin,
                    'status_siswa'        => $status,
                ]
            );

            $berhasil++;
        }

        fclose($handle);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', "{$berhasil} data siswa berhasil diimpor.");
    }
}