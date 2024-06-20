<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHistoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'label' => 'required|string',
            'score' => 'required|string',
            'recommendation' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
