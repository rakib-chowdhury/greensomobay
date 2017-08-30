<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembersResignationValidation extends FormRequest
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
            'savedMoney' => 'required',
            'withdrawMoney' => 'required',
            'applicantName' => 'required',
            'codeName' => 'required',
            'address' => 'required',
            'applicantMobile' => 'required',
        ];
    }
}
