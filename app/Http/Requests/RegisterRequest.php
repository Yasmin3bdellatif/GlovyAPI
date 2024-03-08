<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'birthdate' => 'required|date',
            'name' =>'required|string|max:255'
        ];
    }
}
