<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppoinmentRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'paitent_name' => 'required',
            'mobile'        => 'required',
            'appoinment_date' => 'required',
            'shift_type'  => 'required',
        ];
    }
}
