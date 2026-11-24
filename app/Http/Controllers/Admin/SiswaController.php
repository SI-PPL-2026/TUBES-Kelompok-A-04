<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSiswaRequest;
use App\Http\Requests\UpdateSiswaRequest;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiswaController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->string('q')->trim()->toString();

        $siswa = Siswa::query()
           // ->withCount('peminjaman')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('NISN_siswa', 'like', "%{$q}%")
                        ->orWhere('nama_siswa', 'like', "%{$q}%")
                        ->orWhere('jenis_kelamin_siswa', 'like', "%{$q}%")
                        ->orWhere('status_siswa', 'like', "%{$q}%");
                });
            })
            ->orderBy('id_siswa')
            ->paginate(15)
            ->withQueryString();

        return view('admin.siswa.index', [
            'siswa' => $siswa,
        ]);
    }

    public function store(StoreSiswaRequest $request): RedirectResponse
    {
        Siswa::create($request->validated());

        return redirect()->route('admin.siswa.index');
    }

    public function update(UpdateSiswaRequest $request, Siswa $siswa): RedirectResponse
    {
        $siswa->update($request->validated());

        return redirect()->route('admin.siswa.index');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        //$siswa->loadCount('peminjaman');
        //if ($siswa->peminjaman_count > 0) {
          //  return redirect()->route('admin.siswa.index');
        //  }

        $siswa->delete();

        return redirect()->route('admin.siswa.index');
    }
}