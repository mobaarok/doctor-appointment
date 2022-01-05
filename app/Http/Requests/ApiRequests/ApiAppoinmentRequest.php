<?php

namespace App\Http\Requests\ApiRequests;

class ApiAppoinmentRequest extends ApiRequest
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
            'mobile' => 'required',
            'appoinment_date' => 'required',
        ];

    }
}
