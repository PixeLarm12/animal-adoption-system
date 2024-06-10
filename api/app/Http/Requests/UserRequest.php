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
            'password' => 'required_if:id,null|confirmed|min:8|max:400',
            'cpf' => 'required|unique',
            'birth_date' => 'required|date',
            'phones' => 'required|array|min:1',
            'addresses' => 'required|array|min:1',
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
            'phones.required' => ':attribute is required.',
            'phones.min' => ':attribute must have at least 1 phone number.',
            'addresses.required' => ':attribute is required.',
            'addresses.min' => ':attribute must have at least 1 address.',
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
            'phones' => $this->input('phones'),
            'addresses' => $this->input('addresses'),
        ];
    }
}
