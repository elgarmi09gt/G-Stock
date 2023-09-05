<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ReglementRequest extends FormRequest
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
            'mtrc' => ['required', 'numeric', 'digits_between:1,12'],
            'user_id' => ['required','exists:users,id'],
        ];
    }

    public function prepareForValidation(){
        return $this->merge([
            'user_id' => Auth::user()->id
        ]);
    }
}
