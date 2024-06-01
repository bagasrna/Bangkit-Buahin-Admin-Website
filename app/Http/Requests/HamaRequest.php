<?php

namespace App\Http\Requests;

use App\Exceptions\HamaException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class HamaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->routeIs('hama.create')) {
            return [
                'title' => 'required|string|max:255',
                'category_ids' => 'required|array',
                'category_ids.*' => 'distinct|exists:hama_categories,id',
                'description' => 'required|string',
                'pencegahan' => 'nullable|string',
                'pengendalian' => 'nullable|string',
                'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'daerah_sebaran_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_descriptions.*' => 'nullable|string|max:255',
            ];
        } else if ($this->routeIs('hama.update')) {
            return [
                'title' => 'required|string|max:255',
                'category_ids' => 'required|array',
                'category_ids.*' => 'distinct|exists:hama_categories,id',
                'description' => 'required|string',
                'pencegahan' => 'nullable|string',
                'pengendalian' => 'nullable|string',
                'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'daerah_sebaran_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_descriptions.*' => 'nullable|string|max:255',
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'category_ids.*.distinct' => 'Nilai kategori ada yang duplikat',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();
        throw new HamaException(json_encode($errors));
    }
}
