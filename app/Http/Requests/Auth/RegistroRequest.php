<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
            'primeiro_nome' => 'string|required',
            'sobrenome' => 'string|nullable',
            'cep' => 'required|string|size:8',
            'email' => 'email|unique:users|required',
            'password' => 'string|required',
        ];
    }
}
