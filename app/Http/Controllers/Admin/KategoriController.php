<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\KategoriBuku;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.kategori.index', [
            'kategori' => KategoriBuku::orderBy('nama_kategori')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKategoriRequest $request) : RedirectResponse
    {
        KategoriBuku::create($request->validated());
        return redirect()->route('admin.kategori.index');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, int $kategori) : RedirectResponse
    {
        KategoriBuku::findOrFail($kategori)->update($request->validated());
        return redirect()->route('admin.kategori.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kategori) :  RedirectResponse
    {
        KategoriBuku::findOrFail($kategori)->delete();
        return redirect()->route('admin.kategori.index');
    }
}
