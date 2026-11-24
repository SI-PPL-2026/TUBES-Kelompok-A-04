@php
    $user = auth()->user();
    $role = $user?->role_pengguna ?? 'penjaga';
    $menus = config("menu.{$role}", []);
@endphp

<header class="sticky top-0 z-20 bg-white/95 backdrop-blur-sm border-b border-[#EEEEEE]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-20 h-16 flex items-center justify-between gap-6">
        
        <!-- Brand / Logo -->
        <a href="{{ url('/') }}" class="flex items-center gap-2.5 shrink-0">
            <img src="{{ asset('logo.svg') }}" alt="Logo SMP IT" class="w-8 h-8 object-contain">
            <span class="text-[15px] font-semibold text-[#111111] whitespace-nowrap">
                Perpustakaan SMP IT
            </span>
        </a>

        <!-- Menu Navigasi + Profil -->
        <div class="flex items-center justify-end gap-4 flex-1 min-w-0">
            
            <!-- Navigasi (Bisa di-scroll horizontal di layar kecil) -->
            <nav class="flex items-center gap-6 overflow-x-auto no-scrollbar">
                @foreach ($menus as $item)
                    @php $isActive = request()->routeIs($item['pattern']); @endphp
                    <a href="{{ route($item['route']) }}"
                       class="py-2 px-1 whitespace-nowrap transition-colors {{ $isActive ? 'text-[#111111] font-medium' : 'text-[#8A8A8A] hover:text-[#111111]' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <!-- Info Akun & Tombol Keluar -->
            <div class="flex items-center gap-3 pl-4 border-l border-[#EEEEEE] shrink-0">
                <div class="hidden sm:flex flex-col items-end text-right">
                    <span class="font-medium text-[#111111]">{{ $user?->nama_pengguna ?? 'Guest' }}</span>
                    <span class="text-[#8A8A8A] capitalize">{{ $role }}</span>
                </div>

                <!-- Form Logout Langsung (Lebih sederhana daripada modal terpisah untuk tahap awal) -->
                <form method="POST" action="{}" onsubmit="return confirm('Keluar dari sistem?')">
                    @csrf
                    <button type="submit" title="Keluar"
                            class="w-9 h-9 rounded-full border border-[#EEEEEE] flex items-center justify-center hover:bg-[#FCE4E2] hover:border-[#FCE4E2] transition-colors">
                        <img src="{{ asset('icons/sign-out.svg') }}" alt="Keluar" class="w-4 h-4">
                    </button>
                </form>
            </div>

        </div>
    </div>
</header>