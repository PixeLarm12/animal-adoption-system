<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdoptionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'animal_id' => 'required|integer',
            'person_id' => 'required|integer',
            'status' => 'required|string|min:3|max:20',
            'adoption_date' => 'required|date',
            'observation' => 'sometimes|nullable|string|min:3|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'animal_id.required' => ':attribute is required.',
            'person_id.required' => ':attribute is required.',
            'status.required' => ':attribute is required.',
            'status.min' => ':attribute must have at least 3 characters.',
            'status.max' => ':attribute must have a maximum of 20 characters.',
            'adoption.required' => ':attribute is required.',
            'observation.min' => ':attribute must have at least 3 characters.',
            'observation.max' => ':attribute must have a maximum of 255 characters.',
        ];
    }

    public function getData(): array
    {
        return [
            'animal_id' => $this->input('animal_id'),
            'person_id' => $this->input('person_id'),
            'status' => $this->input('status'),
            'adoption_date' => $this->input('adoption_date'),
            'observation' => $this->input('observation'),
        ];
    }
}
