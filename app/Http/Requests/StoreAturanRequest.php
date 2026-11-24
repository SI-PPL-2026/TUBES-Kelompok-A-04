<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAturanRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'judul_aturan' => ['required', 'string', 'max:255', 'unique:aturan,judul_aturan'],
            'deskripsi_aturan' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'judul_aturan.required' => 'Nama aturan wajib diisi.',
            'judul_aturan.max' => 'Nama aturan maksimal 255 karakter.',
            'judul_aturan.unique' => 'Nama aturan ini sudah ada.',
            'deskripsi_aturan.required' => 'Deskripsi aturan wajib diisi.',
            'deskripsi_aturan.max' => 'Deskripsi aturan maksimal 1000 karakter.',
        ];
    }
}