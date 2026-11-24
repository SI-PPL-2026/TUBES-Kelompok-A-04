<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImporSiswaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'berkas' => ['required', 'file', 'mimes:csv,txt', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'berkas.required' => 'File CSV wajib dipilih',
            'berkas.mimes'    => 'Format file harus berupa CSV (.csv)',
        ];
    }
}