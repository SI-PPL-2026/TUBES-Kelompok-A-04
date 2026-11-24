<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAturanRequest;
use App\Http\Requests\UpdateAturanRequest;
use App\Models\Aturan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AturanController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->string('q')->trim()->toString();

        $aturan = Aturan::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($w) use ($q) {
                    $w->where('judul_aturan', 'like', "%{$q}%")
                      ->orWhere('deskripsi_aturan', 'like', "%{$q}%");
                });
            })
            ->orderBy('id_aturan')
            ->paginate(15)
            ->withQueryString();

        return view('admin.aturan.index', [
            'aturan' => $aturan,
        ]);
    }

    public function store(StoreAturanRequest $request): RedirectResponse
    {
        Aturan::create($request->validated());

        return redirect()->route('admin.aturan.index');
    }

    public function update(UpdateAturanRequest $request, Aturan $aturan): RedirectResponse
    {
        $aturan->update($request->validated());

        return redirect()->route('admin.aturan.index');
    }

    public function destroy(Aturan $aturan): RedirectResponse
    {
        $aturan->delete();

        return redirect()->route('admin.aturan.index');
    }
}