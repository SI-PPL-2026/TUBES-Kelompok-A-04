<x-layout title="Daftar Buku - Perpustakaan SMP IT">

    <x-page-header title="Buku">
        <x-ui.button variant="primary" x-data x-on:click="$dispatch('open-modal', 'tambah-pengguna')">
            Button Primary
        </x-ui.button>
        <x-ui.button variant="secondary" href="{}">
            Button Secondary
        </x-ui.button>
    </x-page-header>

    <div class="ui-section">
        <x-ui.table caption="Daftar pengguna">
            <x-slot:head>
                <th>Nama Pengguna</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th style="width: 133px"><span class="sr-only">Aksi</span></th>
            </x-slot:head>
        </x-ui.table>
    </div>

    <x-ui.modal name="tambah-pengguna" icon="book-bookmark" title="Tambah Pengguna"
        description="Tambahkan akun dari pengguna yang menggunakan sistem perpustakaan ini">

        <x-slot:footer>
            <x-ui.button block x-on:click="$dispatch('close-modal', 'tambah-pengguna')">Batal</x-ui.button>
            <x-ui.button block variant="primary" type="submit">Tambah</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>


</x-layout>
