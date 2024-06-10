<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:60',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|max:400',
            'cpf' => 'required|unique',
            'birth_date' => 'required|date',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => ':attribute is required.',
            'name.min' => ':attribute must have at least 3 characters.',
            'name.max' => ':attribute must have a maximum of 60 characters.',
            'email.required' => ':attribute is required.',
            'email.unique' => ':attribute must be unique.',
            'password.required' => ':attribute is required.',
            'password.min' => ':attribute must have at least 3 characters.',
            'password.max' => ':attribute must have a maximum of 60 characters.',
            'password.confirmed' => 'passwords must match.',
            'cpf.required' => ':attribute is required.',
            'cpf.unique' => ':attribute must be unique.',
            'birth_date.required' => ':attribute is required.',
        ];
    }

    public function getData(): array
    {
        return [
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'password' => $this->input('password'),
            'cpf' => $this->input('cpf'),
            'birth_date' => $this->input('birth_date'),
        ];
    }
}
