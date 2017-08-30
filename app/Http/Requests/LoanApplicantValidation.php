<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanApplicantValidation extends FormRequest
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
            'applicantName' => 'required',
            'applicantGuardian' => 'required',
            'guardianName' => 'required',
            'location' => 'required',
            'postalLocation' => 'required',
            'permanentLocation' => 'required',
            'permanentPostal' => 'required',
            'applicantDate' => 'required',
            'registrationNumber' => 'required',
            'applicantMobile' => 'required',
            'applicantProfession' => 'required',
            'guardianCareers' => 'required',
            'partialRefund' => 'required',
            'proposedLoan' => 'required',
            'creditSector' => 'required',
            'termLoan' => 'required',
            'applicantSignature' => 'required',
            'signatureDate' => 'required',
            'guardianName' => 'required',
            'nomineeRelation' => 'required',
            'guardianSignature' => 'required',
            'witnessSignature1' => 'required',
            'witnessSignature2' => 'required',
            'witnessSignature3' => 'required',
        ];
    }
}
