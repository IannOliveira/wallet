<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarteiraRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'receiver_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0.01'
        ];
    }
}
