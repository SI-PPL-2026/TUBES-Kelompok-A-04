<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->string('q')->trim();

        $siswa = Siswa::query()
            ->when($q->isNotEmpty(), function ($query) use ($q) {
                $query->where('NISN_siswa', 'like', "%{$q}%")
                    ->orWhere('nama_siswa', 'like', "%{$q}%")
                    ->orWhere('jenis_kelamin_siswa', 'like', "%{$q}%")
                    ->orWhere('status_siswa', 'like', "%{$q}%");
            })
            ->orderByDesc('id_siswa')
            ->paginate(10)
            ->withQueryString();

        return view('admin.siswa.index', compact('siswa'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'NISN_siswa' => ['required', 'string', 'max:20', 'unique:siswa,NISN_siswa'],
            'nama_siswa' => ['required', 'string', 'max:255'],
            'jenis_kelamin_siswa' => ['required', Rule::in([Siswa::JENIS_KELAMIN_LAKI, Siswa::JENIS_KELAMIN_PEREMPUAN])],
            'status_siswa' => ['required', Rule::in([Siswa::STATUS_AKTIF, Siswa::STATUS_TIDAK_AKTIF])],
        ]);

        Siswa::create($validated);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function update(Request $request, Siswa $siswa): RedirectResponse
    {
        $validated = $request->validate([
            'NISN_siswa' => [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa', 'NISN_siswa')->ignore($siswa->id_siswa, 'id_siswa'),
            ],
            'nama_siswa' => ['required', 'string', 'max:255'],
            'jenis_kelamin_siswa' => ['required', Rule::in([Siswa::JENIS_KELAMIN_LAKI, Siswa::JENIS_KELAMIN_PEREMPUAN])],
            'status_siswa' => ['required', Rule::in([Siswa::STATUS_AKTIF, Siswa::STATUS_TIDAK_AKTIF])],
        ]);

        $siswa->update($validated);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        $siswa->delete();

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function impor(Request $request): RedirectResponse
    {
        $request->validate([
            'berkas' => ['required', 'file', 'mimes:csv,txt', 'max:2048'],
        ]);

        $handle = fopen($request->file('berkas')->getRealPath(), 'r');

        if ($handle === false) {
            return redirect()
                ->route('admin.siswa.index')
                ->with('error', 'File impor tidak dapat dibaca.');
        }

        $rowIndex = 0;
        $imported = 0;

        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $rowIndex++;

            if (count($row) < 2) {
                continue;
            }

            $firstCol = strtolower(trim((string) ($row[0] ?? '')));
            if ($rowIndex === 1 && in_array($firstCol, ['nisn', 'nisn_siswa'], true)) {
                continue;
            }

            $nisn = trim((string) ($row[0] ?? ''));
            $nama = trim((string) ($row[1] ?? ''));
            $jenisKelamin = trim((string) ($row[2] ?? Siswa::JENIS_KELAMIN_LAKI));
            $status = trim((string) ($row[3] ?? Siswa::STATUS_AKTIF));

            if ($nisn === '' || $nama === '') {
                continue;
            }

            if (! in_array($jenisKelamin, [Siswa::JENIS_KELAMIN_LAKI, Siswa::JENIS_KELAMIN_PEREMPUAN], true)) {
                $jenisKelamin = Siswa::JENIS_KELAMIN_LAKI;
            }

            if (! in_array($status, [Siswa::STATUS_AKTIF, Siswa::STATUS_TIDAK_AKTIF], true)) {
                $status = Siswa::STATUS_AKTIF;
            }

            Siswa::updateOrCreate(
                ['NISN_siswa' => $nisn],
                [
                    'nama_siswa' => $nama,
                    'jenis_kelamin_siswa' => $jenisKelamin,
                    'status_siswa' => $status,
                ]
            );

            $imported++;
        }

        fclose($handle);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', $imported . ' data siswa berhasil diimpor.');
    }
}