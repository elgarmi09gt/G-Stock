<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntreeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'produit_id' => ['required','exists:produits,id'],
            'prix' => ['required','numeric','digits_between:2,12'],
            'quantite' => ['required','numeric','min:1','digits_between:1,6']
        ];
    }
}
