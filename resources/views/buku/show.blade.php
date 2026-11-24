<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $buku->judul_buku }} - Perpustakaan SMP IT</title>
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

    @php
        $kategoriMap = collect($kategoriList)->keyBy('id');
        $katInfo = $buku->id_kategori ? ($kategoriMap->get((int) $buku->id_kategori) ?? null) : null;
        $totalUnit = $buku->items_count > 0 ? $buku->items_count : (int) $buku->stok_buku;
        $tersediaUnit = $buku->items_count > 0 ? $buku->available_items_count : (int) $buku->stok_buku;
    @endphp

    <main class="max-w-6xl w-full mx-auto px-4 sm:px-6 py-8 flex-1">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-800">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-wrap items-center justify-between gap-4 mb-7">
            <a href="{{ route('buku.index') }}" class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-slate-900 transition">
                <span>&larr;</span>
                <span>Kembali ke Buku</span>
            </a>

            <div class="flex items-center gap-2.5">
                <a href="{{ route('buku.edit', $buku) }}"
                   class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-800 hover:bg-slate-50 transition">
                    Ubah Detail Buku
                </a>
                <button type="button" onclick="openModal('modal-hapus-buku')"
                        class="rounded-full bg-[#e11d1d] px-5 py-2 text-xs font-semibold text-white hover:bg-red-700 transition">
                    Hapus
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-start">
            <div class="md:col-span-4">
                <div class="rounded-3xl bg-[#b4b7e8] p-6 min-h-[340px] flex flex-col justify-between text-slate-900 shadow-[0_2px_12px_rgba(15,23,42,0.03)]">
                    <h1 class="text-2xl font-bold leading-snug break-words">
                        {{ $buku->judul_buku }}
                    </h1>
                    <p class="text-xs text-slate-800/80 mt-8">
                        {{ $buku->penulis_buku }}
                    </p>
                </div>
            </div>

            <div class="md:col-span-8 space-y-7">
                <dl class="rounded-2xl bg-white border border-slate-100 px-5 divide-y divide-slate-100 text-xs">
                    <div class="py-3.5 flex items-center justify-between gap-4">
                        <dt class="text-slate-400">Kategori</dt>
                        <dd class="font-medium text-slate-900">
                            @if ($katInfo)
                                <button type="button" onclick="openModal('modal-info-kategori')"
                                        class="inline-flex items-center gap-1 text-[#242468] hover:underline">
                                    <span>{{ $katInfo['nama'] }}</span>
                                    <span>&rarr;</span>
                                </button>
                            @else
                                <span>-</span>
                            @endif
                        </dd>
                    </div>
                    <div class="py-3.5 flex items-center justify-between gap-4">
                        <dt class="text-slate-400">Penerbit</dt>
                        <dd class="font-medium text-slate-900 text-right">{{ $buku->penerbit_buku ?? '-' }}</dd>
                    </div>
                    <div class="py-3.5 flex items-center justify-between gap-4">
                        <dt class="text-slate-400">Tahun Terbit</dt>
                        <dd class="font-medium text-slate-900">{{ $buku->tahun_terbit_buku ?? '-' }}</dd>
                    </div>
                    <div class="py-3.5 flex items-center justify-between gap-4">
                        <dt class="text-slate-400">Jumlah Buku</dt>
                        <dd class="font-medium text-slate-900">{{ $totalUnit }}</dd>
                    </div>
                    <div class="py-3.5 flex items-center justify-between gap-4">
                        <dt class="text-slate-400">Tersedia</dt>
                        <dd class="font-semibold {{ $tersediaUnit > 0 ? 'text-emerald-700' : 'text-rose-600' }}">
                            {{ $tersediaUnit }} dari {{ $totalUnit }}
                        </dd>
                    </div>
                </dl>

                <div>
                    <div class="flex items-center justify-between gap-4 mb-3">
                        <h2 class="text-sm font-bold text-slate-900">Buku Terdaftar</h2>
                        <button type="button" onclick="openModal('modal-tambah-item')"
                                class="inline-flex items-center gap-1 rounded-full bg-[#242468] px-3.5 py-1.5 text-xs font-semibold text-white hover:bg-[#1b1b52] transition">
                            <span>+</span>
                            <span>Tambah Buku</span>
                        </button>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-slate-100 bg-white">
                        <table class="min-w-full text-xs">
                            <thead class="border-b border-slate-100 bg-slate-50/60 text-left text-slate-400">
                                <tr>
                                    <th class="px-4 py-3 font-medium">Kode</th>
                                    <th class="px-4 py-3 font-medium">Status</th>
                                    <th class="px-4 py-3 font-medium">Tgl Beli</th>
                                    <th class="px-4 py-3 font-medium text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse ($buku->items as $item)
                                    @php
                                        $badgeStyle = match($item->status_buku) {
                                            'tersedia' => 'bg-emerald-50 text-emerald-700',
                                            'dipinjam' => 'bg-amber-50 text-amber-700',
                                            'rusak' => 'bg-orange-50 text-orange-700',
                                            'hilang' => 'bg-rose-50 text-rose-700',
                                            default => 'bg-slate-100 text-slate-700',
                                        };
                                    @endphp
                                    <tr class="hover:bg-slate-50/70 transition">
                                        <td class="px-4 py-3.5 font-medium text-slate-900 whitespace-nowrap">{{ $item->kode_buku }}</td>
                                        <td class="px-4 py-3.5 whitespace-nowrap">
                                            <span class="inline-flex rounded-full px-2.5 py-0.5 text-[11px] font-medium {{ $badgeStyle }}">
                                                {{ ucfirst($item->status_buku) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3.5 text-slate-500 whitespace-nowrap">
                                            {{ $item->tanggal_pembelian ? \Carbon\Carbon::parse($item->tanggal_pembelian)->translatedFormat('d M Y') : '-' }}
                                        </td>
                                        <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                            <div class="inline-flex items-center gap-1.5">
                                                <button type="button"
                                                        data-id="{{ $item->id_item_buku }}"
                                                        data-kode="{{ $item->kode_buku }}"
                                                        data-status="{{ $item->status_buku }}"
                                                        data-tanggal="{{ $item->tanggal_pembelian ? \Carbon\Carbon::parse($item->tanggal_pembelian)->format('Y-m-d') : '' }}"
                                                        onclick="openEditItemModal(this)"
                                                        class="inline-flex items-center rounded-lg border border-slate-200 bg-white px-2.5 py-1 text-[11px] font-medium text-slate-700 hover:bg-slate-50 transition">
                                                    Edit
                                                </button>

                                                <button type="button"
                                                        data-id="{{ $item->id_item_buku }}"
                                                        data-kode="{{ $item->kode_buku }}"
                                                        onclick="openDeleteItemModal(this)"
                                                        class="inline-flex items-center rounded-lg border border-rose-200 bg-rose-50/60 px-2.5 py-1 text-[11px] font-medium text-rose-600 hover:bg-rose-100 transition">
                                                    Hapus
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-slate-400">
                                            Belum ada item buku terdaftar. Klik <strong>Tambah Buku</strong> untuk menambahkan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Modal Hapus Detail Buku --}}
    <div id="modal-hapus-buku" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center bg-black/45 px-4">
        <div class="w-full max-w-md rounded-3xl bg-white p-7 text-center shadow-xl">
            <div class="mx-auto mb-4 h-11 w-11 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center text-sm font-bold">
                !
            </div>
            <h3 class="text-base font-bold text-slate-900 mb-2">Hapus detail buku ini?</h3>
            <p class="text-xs text-slate-400 mb-6">
                Jika anda menghapus, maka item buku yang berkaitan dengan detail buku ini juga akan terhapus
            </p>
            <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="grid grid-cols-2 gap-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeModal('modal-hapus-buku')"
                        class="rounded-full border border-slate-200 bg-white py-2.5 text-xs font-semibold text-slate-800 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit"
                        class="rounded-full bg-[#e11d1d] py-2.5 text-xs font-semibold text-white hover:bg-red-700">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>

    {{-- Modal Info Kategori --}}
    <div id="modal-info-kategori" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center bg-black/45 px-4">
        <div class="w-full max-w-md rounded-3xl bg-white p-7 text-center shadow-xl">
            <div class="mx-auto mb-4 h-11 w-11 rounded-full bg-indigo-50 text-[#242468] flex items-center justify-center text-xs font-bold">
                KAT
            </div>
            <h3 class="text-base font-bold text-slate-900 mb-2">Buku {{ $katInfo['nama'] ?? '' }}</h3>
            <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                {{ $katInfo['deskripsi'] ?? 'Kategori buku perpustakaan.' }}
            </p>
            <button type="button" onclick="closeModal('modal-info-kategori')"
                    class="w-full rounded-full border border-slate-200 bg-white py-2.5 text-xs font-semibold text-slate-800 hover:bg-slate-50">
                Tutup
            </button>
        </div>
    </div>

    {{-- Modal Tambah Item Buku --}}
    <div id="modal-tambah-item" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center bg-black/45 px-4">
        <div class="w-full max-w-md rounded-3xl bg-white p-7 shadow-xl">
            <div class="mx-auto mb-3 h-11 w-11 rounded-full bg-indigo-50 text-[#242468] flex items-center justify-center text-sm font-bold">
                +
            </div>
            <h3 class="text-center text-base font-bold text-slate-900">Tambah Item Buku {{ $buku->judul_buku }}</h3>
            <p class="text-center text-xs text-slate-400 mt-1 mb-5">Tambahkan setiap buku yang anda miliki</p>

            <form action="{{ route('buku.items.store', $buku) }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="status_buku" value="tersedia">

                <div>
                    <label for="kode_buku" class="block text-xs font-medium text-slate-700 mb-1.5">Kode Buku</label>
                    <input type="text" id="kode_buku" name="kode_buku" required placeholder="Masukan kode buku"
                           class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs focus:border-[#242468] focus:outline-none">
                </div>

                <div>
                    <label for="tanggal_pembelian" class="block text-xs font-medium text-slate-700 mb-1.5">Tanggal Pembelian</label>
                    <input type="date" id="tanggal_pembelian" name="tanggal_pembelian"
                           class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs focus:border-[#242468] focus:outline-none">
                </div>

                <div class="pt-2 grid grid-cols-2 gap-3">
                    <button type="button" onclick="closeModal('modal-tambah-item')"
                            class="rounded-full border border-slate-200 bg-white py-2.5 text-xs font-semibold text-slate-800 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit"
                            class="rounded-full bg-[#242468] py-2.5 text-xs font-semibold text-white hover:bg-[#1b1b52]">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit Item Buku --}}
    <div id="modal-edit-item" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center bg-black/45 px-4">
        <div class="w-full max-w-md rounded-3xl bg-white p-7 shadow-xl">
            <div class="mx-auto mb-3 h-11 w-11 rounded-full bg-indigo-50 text-[#242468] flex items-center justify-center text-xs font-bold">
                EDIT
            </div>
            <h3 class="text-center text-base font-bold text-slate-900">Edit Item Buku {{ $buku->judul_buku }}</h3>
            <p class="text-center text-xs text-slate-400 mt-1 mb-5">Edit buku yang anda miliki</p>

            <form id="form-edit-item" action="" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="edit-kode-buku" class="block text-xs font-medium text-slate-700 mb-1.5">Kode Buku</label>
                    <input type="text" id="edit-kode-buku" name="kode_buku" required
                           class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs focus:border-[#242468] focus:outline-none">
                </div>

                <div>
                    <label for="edit-status-buku" class="block text-xs font-medium text-slate-700 mb-1.5">Status</label>
                    <select id="edit-status-buku" name="status_buku" required
                            class="w-full rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-xs focus:border-[#242468] focus:outline-none">
                        <option value="tersedia">Tersedia</option>
                        <option value="dipinjam">Dipinjam</option>
                        <option value="rusak">Rusak</option>
                        <option value="hilang">Hilang</option>
                    </select>
                </div>

                <div>
                    <label for="edit-tanggal-pembelian" class="block text-xs font-medium text-slate-700 mb-1.5">Tanggal Pembelian</label>
                    <input type="date" id="edit-tanggal-pembelian" name="tanggal_pembelian"
                           class="w-full rounded-xl border border-slate-200 px-3.5 py-2.5 text-xs focus:border-[#242468] focus:outline-none">
                </div>

                <div class="pt-2 grid grid-cols-2 gap-3">
                    <button type="button" onclick="closeModal('modal-edit-item')"
                            class="rounded-full border border-slate-200 bg-white py-2.5 text-xs font-semibold text-slate-800 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit"
                            class="rounded-full bg-[#242468] py-2.5 text-xs font-semibold text-white hover:bg-[#1b1b52]">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Hapus Item Buku --}}
    <div id="modal-hapus-item" class="modal-backdrop fixed inset-0 z-50 hidden items-center justify-center bg-black/45 px-4">
        <div class="w-full max-w-md rounded-3xl bg-white p-7 text-center shadow-xl">
            <div class="mx-auto mb-4 h-11 w-11 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center text-sm font-bold">
                !
            </div>
            <h3 id="hapus-item-title" class="text-base font-bold text-slate-900 mb-2">Hapus buku ini?</h3>
            <p class="text-xs text-slate-400 mb-6">
                Jika anda menghapus, maka item buku tersebut akan permanen terhapus
            </p>
            <form id="form-hapus-item" action="" method="POST" class="grid grid-cols-2 gap-3">
                @csrf
                @method('DELETE')
                <button type="button" onclick="closeModal('modal-hapus-item')"
                        class="rounded-full border border-slate-200 bg-white py-2.5 text-xs font-semibold text-slate-800 hover:bg-slate-50">
                    Batal
                </button>
                <button type="submit"
                        class="rounded-full bg-[#e11d1d] py-2.5 text-xs font-semibold text-white hover:bg-red-700">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>

    <script>
        function openModal(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.remove('hidden');
            el.classList.add('flex');
        }

        function closeModal(id) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.add('hidden');
            el.classList.remove('flex');
        }

        function openEditItemModal(btn) {
            const id = btn.dataset.id;
            const form = document.getElementById('form-edit-item');
            form.action = `{{ url('/item-buku') }}/${id}`;

            document.getElementById('edit-kode-buku').value = btn.dataset.kode || '';
            document.getElementById('edit-status-buku').value = btn.dataset.status || 'tersedia';
            document.getElementById('edit-tanggal-pembelian').value = btn.dataset.tanggal || '';

            openModal('modal-edit-item');
        }

        function openDeleteItemModal(btn) {
            const id = btn.dataset.id;
            const kode = btn.dataset.kode || 'item';
            const form = document.getElementById('form-hapus-item');
            form.action = `{{ url('/item-buku') }}/${id}`;

            document.getElementById('hapus-item-title').textContent = `Hapus buku ${kode} ini?`;
            openModal('modal-hapus-item');
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.modal-backdrop').forEach((backdrop) => {
                backdrop.addEventListener('click', (e) => {
                    if (e.target === backdrop) {
                        backdrop.classList.add('hidden');
                        backdrop.classList.remove('flex');
                    }
                });
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    document.querySelectorAll('.modal-backdrop').forEach((backdrop) => {
                        backdrop.classList.add('hidden');
                        backdrop.classList.remove('flex');
                    });
                }
            });
        });
    </script>
</body>
</html>