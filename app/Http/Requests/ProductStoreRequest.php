<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'supplier_reference' => 'required',
            'barcode' => 'required',
            'designation' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'supplier_reference.required' => 'Veuillez entrer la référence du fournisseur',
            'barcode.required' => 'Veuillez entrer le barcode',
            'designation.required' => 'Veuillez entrer la désignation',
            'quantity.required' => 'Veuillez entrer la quantité',
            'amount.required' => 'Veuillez entrer le montant',
        ];
    }
}
