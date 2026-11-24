<x-layout title="Daftar Buku - Perpustakaan SMP IT">

    <x-page-header title="Buku">
        <x-ui.button variant="primary" href="{}">
            Button Primary
        </x-ui.button>
        <x-ui.button variant="secondary" href="{}">
            Button Secondary
        </x-ui.button>
    </x-page-header>

    <div class="ui-section">
        <x-ui.table caption="Daftar pengguna" :paginator="$pengguna">
            <x-slot:head>
                <th>Nama Pengguna</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th style="width: 133px"><span class="sr-only">Aksi</span></th>
            </x-slot:head>

            @forelse ($pengguna as $u)
                <tr>
                    <td>{{ $u->nama_pengguna }}</td>
                    <td>{{ $u->username_pengguna }}</td>
                    {{-- Ditampilkan apa adanya supaya admin bisa membacakannya ke pemilik akun. --}}
                    <td>{{ $u->password_pengguna }}</td>
                    <td><x-ui.badge tone="brand">{{ $u->role_pengguna }}</x-ui.badge></td>
                    <td>
                        <x-ui.row-actions label="pengguna {{ $u->nama_pengguna }}"
                            edit-modal="ubah-pengguna-{{ $u->id_pengguna }}"
                            delete-modal="hapus-pengguna-{{ $u->id_pengguna }}" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="ui-table__empty">
                        {{ request('q') ? 'Tidak ada pengguna yang cocok' : 'Belum ada data pengguna' }}
                    </td>
                </tr>
            @endforelse
        </x-ui.table>
    </div>


</x-layout>
