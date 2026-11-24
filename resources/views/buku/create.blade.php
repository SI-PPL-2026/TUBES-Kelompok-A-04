<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Buku - Perpustakaan SMP IT</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fafafa] text-slate-900 antialiased min-h-screen flex flex-col">
    <header class="bg-white border-b border-slate-100 sticky top-0 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between gap-4">
            <a href="{{ route('buku.index') }}" class="flex items-center gap-2.5 shrink-0">
                @if (file_exists(public_path('logo.svg')))
                    <img src="{{ asset('logo.svg') }}" alt="Logo Perpustakaan SMP IT" class="h-8 w-8 object-contain">
                @else
                    <span class="h-8 w-8 rounded-full bg-[#242468] text-white text-xs font-bold flex items-center justify-center">
                        SMP
                    </span>
                @endif
                <span class="font-bold text-slate-900 tracking-tight">Perpustakaan SMP IT</span>
            </a>

            <nav class="hidden lg:flex items-center gap-6 text-sm text-slate-500">
                <a href="{{ url('/dashboard') }}" class="hover:text-slate-900 transition">Dashboard</a>
                <a href="{{ route('buku.index') }}" class="font-semibold text-[#242468]">Buku</a>
                <a href="{{ url('/admin/kategori') }}" class="hover:text-slate-900 transition">Kategori</a>
                <span class="cursor-default text-slate-400">Siswa</span>
                <span class="cursor-default text-slate-400">Pengguna</span>
                <a href="{{ url('/admin/jenis-denda') }}" class="hover:text-slate-900 transition">Jenis Denda</a>
                <span class="cursor-default text-slate-400">Aturan</span>
            </nav>

            <div class="text-right leading-tight shrink-0">
                <div class="text-xs font-semibold text-slate-900">Admin Perpustakaan</div>
                <div class="text-[11px] text-slate-400">Superadmin</div>
            </div>
        </div>
    </header>

    <main class="max-w-4xl w-full mx-auto px-4 sm:px-6 py-8 flex-1">
        <a href="{{ route('buku.index') }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-slate-900 transition mb-5">
            <span>&larr;</span>
            <span>Kembali ke Buku</span>
        </a>

        <div class="mb-6">
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Tambahkan Informasi Detail Buku</h1>
            <p class="text-xs text-slate-400 mt-1">Lengkapi data katalog utama sebelum menambahkan eksemplar buku</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('buku.store') }}" method="POST"
              class="rounded-3xl bg-white border border-slate-100 p-6 sm:p-7 shadow-[0_2px_12px_rgba(15,23,42,0.03)] space-y-5">
            @csrf

            <div>
                <label for="judul_buku" class="block text-xs font-medium text-slate-700 mb-2">Judul</label>
                <input type="text" id="judul_buku" name="judul_buku" value="{{ old('judul_buku') }}" required
                       placeholder="Masukan judul buku"
                       class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-[#242468] focus:outline-none transition">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="id_kategori" class="block text-xs font-medium text-slate-700 mb-2">Kategori</label>
                    <select id="id_kategori" name="id_kategori"
                            class="w-full rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm text-slate-800 focus:border-[#242468] focus:outline-none transition">
                        <option value="">Pilih kategori buku</option>
                        @foreach ($kategoriList as $kat)
                            <option value="{{ $kat['id'] }}" {{ (string) old('id_kategori') === (string) $kat['id'] ? 'selected' : '' }}>
                                {{ $kat['nama'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="penulis_buku" class="block text-xs font-medium text-slate-700 mb-2">Penulis</label>
                    <input type="text" id="penulis_buku" name="penulis_buku" value="{{ old('penulis_buku') }}" required
                           placeholder="Masukan penulis"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-[#242468] focus:outline-none transition">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label for="penerbit_buku" class="block text-xs font-medium text-slate-700 mb-2">Penerbit (opsional)</label>
                    <input type="text" id="penerbit_buku" name="penerbit_buku" value="{{ old('penerbit_buku') }}"
                           placeholder="Masukan penerbit buku"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-[#242468] focus:outline-none transition">
                </div>

                <div>
                    <label for="tahun_terbit_buku" class="block text-xs font-medium text-slate-700 mb-2">Tahun Terbit (opsional)</label>
                    <input type="number" id="tahun_terbit_buku" name="tahun_terbit_buku" value="{{ old('tahun_terbit_buku') }}"
                           min="1000" max="{{ date('Y') }}" placeholder="Masukan tahun terbit buku"
                           class="w-full rounded-xl border border-slate-200 px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-[#242468] focus:outline-none transition">
                </div>
            </div>

            <div class="pt-3 flex items-center justify-end gap-3">
                <a href="{{ route('buku.index') }}"
                   class="rounded-full border border-slate-200 bg-white px-5 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition">
                    Batal
                </a>
                <button type="submit"
                        class="rounded-full bg-[#242468] px-6 py-2 text-xs font-semibold text-white hover:bg-[#1b1b52] transition">
                    Simpan Buku
                </button>
            </div>
        </form>
    </main>
</body>
</html>