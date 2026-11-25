<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    public const JENIS_KELAMIN_LAKI = 'Laki-laki';
    public const JENIS_KELAMIN_PEREMPUAN = 'Perempuan';
    public const STATUS_AKTIF = 'Aktif';
    public const STATUS_TIDAK_AKTIF = 'Tidak Aktif';

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;

    protected $fillable = [
        'NISN_siswa',
        'nama_siswa',
        'jenis_kelamin_siswa',
        'status_siswa',
    ];
}