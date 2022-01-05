<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class HospitalStoreRequest extends FormRequest
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
            'hospital_name' => 'required',
            'mobile_phone'  => 'required|unique:hospitals',
            'email'         => 'required|unique:hospitals',
            'password'      => 'required|confirmed',
            'division'      => 'required',
            'district'      => 'required',
            'upazila'       => 'required',
        ];
    }
}
