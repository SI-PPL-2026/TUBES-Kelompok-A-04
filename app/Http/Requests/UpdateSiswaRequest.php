<?php

namespace App\Http\Requests;

use App\Models\Siswa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $siswaParam = $this->route('siswa');
        $siswaId = is_object($siswaParam) ? $siswaParam->id_siswa : $siswaParam;

        return [
            'NISN_siswa'          => [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa', 'NISN_siswa')->ignore($siswaId, 'id_siswa'),
            ],
            'nama_siswa'          => ['required', 'string', 'max:150'],
            'jenis_kelamin_siswa' => [
                'required',
                Rule::in([Siswa::JENIS_KELAMIN_LAKI, Siswa::JENIS_KELAMIN_PEREMPUAN]),
            ],
            'status_siswa'        => [
                'required',
                Rule::in([Siswa::STATUS_AKTIF, Siswa::STATUS_TIDAK_AKTIF]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'NISN_siswa.required'          => 'NISN wajib diisi',
            'NISN_siswa.unique'            => 'NISN sudah terdaftar',
            'nama_siswa.required'          => 'Nama wajib diisi',
            'jenis_kelamin_siswa.required' => 'Jenis kelamin wajib dipilih',
            'status_siswa.required'        => 'Status wajib dipilih',
        ];
    }
}