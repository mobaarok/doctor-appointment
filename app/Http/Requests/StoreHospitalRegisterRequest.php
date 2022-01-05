<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHospitalRegisterRequest extends FormRequest
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
            'hospital_name'   => 'required',
            'email'         => 'required|email|unique:hospitals',
            'mobile_phone'  => 'required|unique:hospitals,mobile_phone|size:11',
            'password'       => 'required|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6',
            'agree' => 'required',
        ];
    }
}
