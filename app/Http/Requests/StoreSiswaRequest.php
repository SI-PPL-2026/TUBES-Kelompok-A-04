<?php

namespace App\Http\Requests;

use App\Models\Siswa;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'NISN_siswa' => ['required', 'string', 'max:20', 'unique:siswa,NISN_siswa'],
            'nama_siswa' => ['required', 'string', 'max:150'],
            'jenis_kelamin_siswa' => [
                'required',
                Rule::in([Siswa::JENIS_KELAMIN_LAKI, Siswa::JENIS_KELAMIN_PEREMPUAN]),
            ],
            'status_siswa' => [
                'required',
                Rule::in([Siswa::STATUS_AKTIF, Siswa::STATUS_TIDAK_AKTIF]),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'NISN_siswa.required' => 'NISN wajib diisi.',
            'NISN_siswa.max' => 'NISN maksimal 20 karakter.',
            'NISN_siswa.unique' => 'NISN sudah terdaftar.',
            'nama_siswa.required' => 'Nama siswa wajib diisi.',
            'nama_siswa.max' => 'Nama siswa maksimal 150 karakter.',
            'jenis_kelamin_siswa.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin_siswa.in' => 'Jenis kelamin tidak valid.',
            'status_siswa.required' => 'Status wajib dipilih.',
            'status_siswa.in' => 'Status tidak valid.',
        ];
    }
}