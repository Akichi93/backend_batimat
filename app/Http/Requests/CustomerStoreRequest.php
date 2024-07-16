<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'firstname.required' => 'Veuillez entrer le nom du client',
            'lastname.required' => 'Veuillez entrer le prénom du client',
            'phone.required' => 'Veuillez entrer le contact',
        ];
    }
}
