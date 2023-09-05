<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ProduitRequest extends FormRequest
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
            'reference' => ['required', 'min:3', Rule::unique('produits')->ignore($this->route()->parameter('produit'))],
            'libelle' => ['required', 'min:8'],
            'active' => ['required', 'integer'],
            'user_id' => ['required','exists:users,id'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'active' => 1,
            'user_id' => Auth::user()->id
        ]);
    }
}
