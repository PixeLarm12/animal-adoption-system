<?php

namespace App\Http\Requests;

use App\Models\Adoption;
use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:80',
            'specie' => 'required|string|max:80',
            'sex' => 'required|string|max:5',
            'description' => 'required|string|min:3|max:255',
            'entry_date' => 'required|date',
            'birth_date' => 'sometimes|nullable|date',
            'vaccines' => 'sometimes|nullable|array',
            'medical_informations' => 'sometimes|nullable|array',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute is required.',
            'name.min' => ':attribute must have at least 3 characters.',
            'name.max' => ':attribute must have a maximum of 80 characters.',
            'specie.required' => ':attribute is required.',
            'specie.max' => ':attribute must have a maximum of 80 characters.',
            'sex.required' => ':attribute is required.',
            'sex.max' => ':attribute must have a maximum of 5 characters.',
            'description.required' => ':attribute is required.',
            'description.min' => ':attribute must have at least 3 characters.',
            'description.max' => ':attribute must have a maximum of 255 characters.',
            'entry_date.required' => ':attribute is required.',
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->input('name'),
            'adoption_status' => Adoption::ADOPTION_STATUS_NOT_STARTED,
            'specie' => $this->input('specie'),
            'sex' => $this->input('sex'),
            'description' => $this->input('description'),
            'entry_date' => $this->input('entry_date'),
            'birth_date' => $this->input('birth_date'),
            'vaccines' => $this->input('vaccines'),
            'medical_informations' => $this->input('medical_informations'),
        ];
    }
}
