<?php

namespace App\Http\Requests;

use App\Models\Vente;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class VenteRequest extends FormRequest
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
            'reference' => ['required', 'min:3', Rule::unique('ventes')->ignore($this->route()->parameter('vente'))],
            //'client_id' => ['nullable', 'exists:clients,id', 'accepted:null'],
            'etat' => ['required', 'integer'],
            'mois' => ['required', 'integer']
        ];
    }

    public function prepareForValidation()
    {
        $ref = 'VEN_0000001';
        $vente = Vente::all('id')->last();
        if ($vente) {
            if (10 > $vente->id) {
                $ref = 'VEN_000000' . $vente->id + 1;
            } elseif (100 > $vente->id) {
                $ref = 'VEN_00000' . $vente->id + 1;
            } elseif (1000 > $vente->id) {
                $ref = 'VEN_0000' . $vente->id + 1;
            } elseif (10000 > $vente->id) {
                $ref = 'VEN_000' . $vente->id + 1;
            } elseif (100000 > $vente->id) {
                $ref = 'VEN_00' . $vente->id + 1;
            } elseif (1000000 > $vente->id) {
                $ref = 'VEN_0' . $vente->id + 1;
            } elseif (10000000 > $vente->id) {
                $ref = 'VEN_' . $vente->id + 1;
            }
        }
        $this->merge([
            'etat' => 0,
            'mois' => Carbon::now()->month,
            'reference' => $ref
        ]);
    }
}
