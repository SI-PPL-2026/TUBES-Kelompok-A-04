<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kategori Buku</title>
</head>
<body>
    <h1>Kategori Buku</h1>

    @if (session('status'))
        <p style="color: green">{{ session('status') }}</p>
    @endif

    <h2>Tambah Kategori</h2>
    <form method="POST" action="{{ route('admin.kategori.store') }}">
        @csrf
        <label>Nama Kategori<br>
            <input type="text" name="nama_kategori" value="{{ old('nama_kategori') }}">
        </label>
        @error('nama_kategori') <p style="color: red">{{ $message }}</p> @enderror
        <br><br>
        <label>Deskripsi<br>
            <textarea name="deskripsi_kategori">{{ old('deskripsi_kategori') }}</textarea>
        </label>
        <br><br>
        <button type="submit">Tambah</button>
    </form>

    <hr>

    <h2>Daftar Kategori</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        @forelse ($kategori as $k)
            <tr>
                <td>{{ $k->nama_kategori }}</td>
                <td>{{ $k->deskripsi_kategori }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.kategori.update', $k) }}" style="display:inline">
                        @csrf @method('PUT')
                        <input type="text" name="nama_kategori" value="{{ $k->nama_kategori }}">
                        <input type="text" name="deskripsi_kategori" value="{{ $k->deskripsi_kategori }}">
                        <button type="submit">Simpan</button>
                    </form>
                    <form method="POST" action="{{ route('admin.kategori.destroy', $k) }}" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Hapus kategori ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="3">Belum ada data kategori</td></tr>
        @endforelse
    </table>
</body>
</html>
