<?php

namespace App\Http\Requests;

use App\Exceptions\GulmaException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class AdsRequest extends FormRequest
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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
        } else if ($this->routeIs('penyakit.update')) {
            return [
                'title' => 'required|string|max:255',
            ];
        }

        return [];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->getMessages();
        throw new GulmaException(json_encode($errors));
    }
}
