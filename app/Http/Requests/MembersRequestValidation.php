<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MembersRequestValidation extends FormRequest
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
            'applierName' => 'required',
            'applierOccupation' => 'required',
            'guardianName' => 'required',
            'guardianOccupation' => 'required',
            'motherName' => 'required',
            'motherOccupation' => 'required',
            'location' => 'required',
            'postalLocation' => 'required',
            'division' => 'required',
            'district' => 'required',
            'thana' => 'required',
            'permanentLocation' => 'required',
            'permanentPostal' => 'required',
            'permanentDivision' => 'required',
            'permanentDistrict' => 'required',
            'permanentThana' => 'required',
            'nationalism' => 'required',
            'religion' => 'required',
            'idNumber' => 'required|min:17|max:17',
            'bloodGroup' => 'required',
            'educationQuality' => 'required',
            'maritalStatus' => 'required',
            'nomineeName' => 'required',
            'nomineeRelation' => 'required',
            'phoneNumber' => 'required|max:11|min:7',
            'officeLocation' => 'required',
            'picture' => 'required',
            'nomineePicture' => 'required',
        ];
    }
}
