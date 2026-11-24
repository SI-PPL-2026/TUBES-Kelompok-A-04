<?php

namespace Database\Seeders;

use App\Models\Aturan;
use Illuminate\Database\Seeder;

class AturanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['Batas waktu pinjaman harian', 'Buku harian dipinjam maksimal 7 hari dan wajib dikembalikan sebelum atau pada tanggal harus kembali.'],
            ['Buku pelajaran semester', 'Buku pelajaran dipinjam selama satu semester dan dikembalikan paling lambat di akhir semester.'],
            ['Denda keterlambatan', 'Keterlambatan pengembalian dikenakan denda Rp1.000 per hari untuk setiap buku.'],
            ['Kerusakan dan kehilangan', 'Buku yang rusak atau hilang dikenakan denda sesuai jenis denda yang berlaku.'],
            ['Jaga kondisi buku', 'Dilarang mencoret, melipat, atau merobek halaman buku.'],
        ];

        foreach ($data as [$judul, $deskripsi]) {
            Aturan::firstOrCreate(
                ['judul_aturan' => $judul],
                ['deskripsi_aturan' => $deskripsi],
            );
        }
    }
}