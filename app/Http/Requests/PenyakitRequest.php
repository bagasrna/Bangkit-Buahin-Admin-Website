<?php

namespace App\Http\Requests;

use App\Exceptions\PenyakitException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class PenyakitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->routeIs('penyakit.create')) {
            return [
                'title' => 'required|string|max:255|unique:penyakits,title',
                'category_ids' => 'required|array',
                'category_ids.*' => 'distinct|exists:penyakit_categories,id',
                'description' => 'required|string',
                'penyebab_penyakit' => 'nullable|string',
                'pengendalian' => 'nullable|string',
                'penularan_penyakit' => 'nullable|string',
                'waktu_terjadi_serangan' => 'nullable|string',
                'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'daerah_sebaran_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_descriptions.*' => 'nullable|string|max:255',
            ];
        } else if ($this->routeIs('penyakit.update')) {
            return [
                'title' => 'required|string|max:255',
                'category_ids' => 'required|array',
                'category_ids.*' => 'distinct|exists:penyakit_categories,id',
                'description' => 'required|string',
                'penyebab_penyakit' => 'nullable|string',
                'pengendalian' => 'nullable|string',
                'penularan_penyakit' => 'nullable|string',
                'waktu_terjadi_serangan' => 'nullable|string',
                'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'daerah_sebaran_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_descriptions.*' => 'nullable|string|max:255',
            ];
        }

        return [];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();
        throw new PenyakitException(json_encode($errors));
    }
}
