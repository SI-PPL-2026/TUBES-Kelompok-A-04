<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku - Perpustakaan SMP IT</title>
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

    <main class="max-w-7xl w-full mx-auto px-4 sm:px-6 py-8 flex-1">
        @if (session('success'))
            <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800 flex items-center justify-between gap-3">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">Buku</h1>
                <p class="text-xs text-slate-400 mt-1">Kelola katalog buku dan pantau ketersediaan eksemplar</p>
            </div>
            <div class="flex items-center gap-2.5">
                <a href="{{ route('buku.create') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-full bg-[#242468] px-5 py-2.5 text-sm font-medium text-white hover:bg-[#1b1b52] transition shadow-xs">
                    <span>+</span>
                    <span>Tambah Buku</span>
                </a>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-7">
            <div id="filter-tabs" class="inline-flex flex-wrap items-center gap-1 rounded-2xl sm:rounded-full bg-slate-100 p-1 text-sm">
                <button type="button" data-filter="all"
                        class="filter-tab rounded-full bg-white px-4 py-1.5 font-medium text-slate-900 shadow-xs transition">
                    Semua
                </button>
                @foreach ($kategoriList as $kat)
                    <button type="button" data-filter="{{ $kat['id'] }}"
                            class="filter-tab rounded-full px-4 py-1.5 font-medium text-slate-500 hover:text-slate-800 transition">
                        {{ $kat['nama'] }}
                    </button>
                @endforeach
            </div>

            <div class="relative w-full md:w-72">
                <input id="search-buku" type="text" placeholder="Cari judul atau penulis..."
                       class="w-full rounded-full border border-slate-200 bg-white pl-4 pr-9 py-2 text-sm text-slate-800 placeholder:text-slate-400 focus:border-[#242468] focus:outline-none transition">
                <button id="clear-search" type="button" aria-label="Hapus pencarian"
                        class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 text-sm leading-none">
                    &times;
                </button>
            </div>
        </div>

        <div id="buku-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($buku as $item)
                @php
                    $totalUnit = $item->items_count > 0 ? $item->items_count : (int) $item->stok_buku;
                    $tersediaUnit = $item->items_count > 0 ? $item->available_items_count : (int) $item->stok_buku;
                @endphp
                <article class="buku-card rounded-3xl bg-white border border-slate-100 p-5 shadow-[0_2px_12px_rgba(15,23,42,0.03)] hover:border-slate-200 transition flex flex-col justify-between"
                         data-kategori="{{ $item->id_kategori ?? '' }}"
                         data-search="{{ strtolower($item->judul_buku . ' ' . $item->penulis_buku) }}">
                    <div>
                        <div class="flex items-center justify-between gap-2 text-xs text-slate-400 mb-3">
                            <span class="{{ $tersediaUnit > 0 ? 'text-emerald-700 font-medium' : 'text-rose-600 font-medium' }}">
                                Tersedia {{ $tersediaUnit }} dari {{ $totalUnit }}
                            </span>
                            <span>{{ $item->tahun_terbit_buku ?? '-' }}</span>
                        </div>

                        <div class="rounded-2xl bg-[#b4b7e8] px-5 py-6 min-h-[230px] flex flex-col justify-between text-slate-900">
                            <h2 class="text-xl font-bold leading-snug break-words">
                                {{ $item->judul_buku }}
                            </h2>
                            <p class="text-xs text-slate-800/80 mt-6 truncate">
                                {{ $item->penulis_buku }}
                            </p>
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-100 text-center">
                        <a href="{{ route('buku.show', $item) }}"
                           class="inline-block text-xs font-medium text-slate-700 hover:text-[#242468] transition">
                            Lihat detail
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-3xl bg-white border border-slate-100 p-10 text-center">
                    <p class="text-slate-500 text-sm mb-4">Belum ada data buku yang tercatat.</p>
                    <a href="{{ route('buku.create') }}"
                       class="inline-flex items-center justify-center rounded-full bg-[#242468] px-5 py-2 text-sm font-medium text-white hover:bg-[#1b1b52] transition">
                        Tambah Buku Pertama
                    </a>
                </div>
            @endforelse
        </div>

        <p id="empty-filter-msg" class="hidden mt-8 text-center text-sm text-slate-400">
            Tidak ada buku yang cocok dengan filter atau kata kunci pencarian.
        </p>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tabs = document.querySelectorAll('.filter-tab');
            const searchInput = document.getElementById('search-buku');
            const clearBtn = document.getElementById('clear-search');
            const cards = document.querySelectorAll('.buku-card');
            const emptyMsg = document.getElementById('empty-filter-msg');

            let activeKategori = 'all';

            function applyFilter() {
                const keyword = (searchInput?.value || '').trim().toLowerCase();
                let visibleCount = 0;

                if (clearBtn) {
                    clearBtn.classList.toggle('hidden', keyword === '');
                }

                cards.forEach((card) => {
                    const cardKat = card.dataset.kategori || '';
                    const searchText = card.dataset.search || '';
                    const matchKat = activeKategori === 'all' || cardKat === String(activeKategori);
                    const matchSearch = keyword === '' || searchText.includes(keyword);

                    if (matchKat && matchSearch) {
                        card.classList.remove('hidden');
                        card.classList.add('flex');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                        card.classList.remove('flex');
                    }
                });

                if (emptyMsg && cards.length > 0) {
                    emptyMsg.classList.toggle('hidden', visibleCount > 0);
                }
            }

            tabs.forEach((tab) => {
                tab.addEventListener('click', () => {
                    activeKategori = tab.dataset.filter;
                    tabs.forEach((t) => {
                        t.classList.remove('bg-white', 'text-slate-900', 'shadow-xs');
                        t.classList.add('text-slate-500');
                    });
                    tab.classList.add('bg-white', 'text-slate-900', 'shadow-xs');
                    tab.classList.remove('text-slate-500');
                    applyFilter();
                });
            });

            searchInput?.addEventListener('input', applyFilter);

            clearBtn?.addEventListener('click', () => {
                if (!searchInput) return;
                searchInput.value = '';
                applyFilter();
                searchInput.focus();
            });
        });
    </script>
</body>
</html>