<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AIFormRequest extends FormRequest
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
            'Fo' => 'required',
            'Fio' => 'required',
            'Fhi' => 'required',
            'Jitter' => 'required',
            'Rap' => 'required',
            'Ppq' => 'required',
            'Shimmer' => 'required',
            'Dpq' => 'required'
        ];
    }
}
