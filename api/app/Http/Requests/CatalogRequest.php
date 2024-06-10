<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:80',
            'description' => 'required|string|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => ':attribute is required.',
            'title.min' => ':attribute must have at least 3 characters.',
            'title.max' => ':attribute must have a maximum of 80 characters.',
            'description.required' => ':attribute is required.',
            'description.min' => ':attribute must have at least 3 characters.',
            'description.max' => ':attribute must have a maximum of 255 characters.',
        ];
    }

    public function getData(): array
    {
        return [
            'title' => $this->input('title'),
            'description' => $this->input('description'),
        ];
    }
}
