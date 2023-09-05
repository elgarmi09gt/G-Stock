<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'prenoms'=>['required'],
            'nom'=>['required'],
            'telephone'=>['required','max:9','regex:/(7)[0-9]{8}/',Rule::unique('clients')->ignore($this->route()->parameter('client'))],
            'user_id' => ['required','exists:users,id'],
        ];
    }

    public function prepareForValidation(){
        return $this->merge([
            'user_id' => Auth::user()->id
        ]);
    }
}//, 'min:9','max:9'
