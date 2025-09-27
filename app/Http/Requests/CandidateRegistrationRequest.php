<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        // restrict by auth if needed
        return true;
    }

    public function rules()
    {
        return [
            // personal
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date_format:Y-m-d', // we convert dates to ISO before submit (see JS)
            'mobile_cc' => 'required|string',
            'mobile_number' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $cc = $this->input('mobile_cc');
                    if (
                        \App\Models\CandidateProfile::where('mobile_cc', $cc)
                            ->where('mobile_number', $value)
                            ->exists()
                    ) {
                        $fail('The mobile number with this country code is already taken.');
                    }
                }
            ],
            'whatsapp_cc' => 'required_with:whatsapp_number|string',
            'whatsapp_number' => [
                'nullable',
                'string',
                function ($attribute, $value, $fail) {
                    $cc = $this->input('whatsapp_cc');
                    if ($value && $cc) {
                        if (
                            \App\Models\CandidateProfile::where('whatsapp_cc', $cc)
                                ->where('whatsapp_number', $value)
                                ->exists()
                        ) {
                            $fail('The WhatsApp number with this country code is already taken.');
                        }
                    }
                }
            ],
            'address' => 'nullable|string|max:1000',

            // nationality and document-country fields now reference countries.id
            'nationality' => 'nullable|integer|exists:countries,id',
            'passport_nationality' => 'nullable|integer|exists:countries,id',
            'cdc_nationality' => 'nullable|integer|exists:countries,id',
            'coc_held' => 'nullable|integer|exists:countries,id',

            // profile/resume
            'present_rank' => 'nullable|exists:ranks,id',
            'present_rank_exp' => 'nullable|string|max:50',
            'post_applied_for' => 'nullable|exists:ranks,id',
            'date_of_availability' => 'nullable|date_format:Y-m-d',
            'indos_number' => 'nullable|string|max:100',

            // documents
            'passport_number' => 'nullable|string|max:100',
            'passport_expiry' => 'nullable|date_format:Y-m-d',
            'cdc_no' => 'nullable|string|max:100',
            'cdc_expiry' => 'nullable|date_format:Y-m-d',

            // presea/coc
            'presea_training_type' => 'nullable|string|max:255',
            'presea_training_issue_date' => 'nullable|date_format:Y-m-d',
            'coc_no' => 'nullable|string|max:100',
            'coc_grade' => 'nullable|string|max:100',
            'coc_type' => 'nullable|string|max:255',
            'coc_date_of_expiry' => 'nullable|date_format:Y-m-d',

            // dce endorsements
            'dce_id' => 'nullable|array',
            'dce_id.*' => 'nullable|exists:dce_endorsements,id',
            'dce_validity' => 'nullable|array',
            'dce_validity.*' => 'nullable|date_format:Y-m-d',

            // courses (master table: courses_and_other_certificate_master)
            'courses' => 'nullable|array',
            'courses.*' => 'nullable|exists:courses_and_other_certificate_master,id',

            // sea service (nested)
            'sea_service' => 'nullable|array',
            'sea_service.*.rank_id' => 'nullable|exists:ranks,id',
            'sea_service.*.ship_type_id' => 'nullable|exists:ship_types,id',
            'sea_service.*.sign_on' => 'nullable|date_format:Y-m-d',
            'sea_service.*.sign_off' => 'nullable|date_format:Y-m-d',
            'sea_service.*.company_name' => 'nullable|string|max:255',
            'sea_service.*.ship_name' => 'nullable|string|max:255',

            // replaced old grt/tonnage rules with a unit + value pair:
            'sea_service.*.grt_unit' => 'nullable|in:GRT,DWT',
            'sea_service.*.grt_value' => 'nullable|numeric',
            'sea_service.*.bhp' => 'nullable|numeric',

            // file
            'profile_pic' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',

            // additional
            'additional_information' => 'nullable|string|max:2000',
            'state_id' => 'nullable|exists:states,id',
            'city_id' => 'nullable|exists:cities,id',
            'usa_visa' => 'nullable|string',
            'cdc_number' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The candidate email is already taken.',
            'password.confirmed' => 'Passwords do not match.',
            'courses.*.exists' => 'One of the selected courses is invalid.',
            'dce_id.*.exists' => 'Invalid DCE selection.',
            'nationality.exists' => 'Selected nationality is invalid.',
            'passport_nationality.exists' => 'Selected passport nationality is invalid.',
            'cdc_nationality.exists' => 'Selected CDC nationality is invalid.',
            'coc_held.exists' => 'Selected COC country is invalid.',
            'sea_service.*.rank_id.exists' => 'Selected rank for a sea service entry is invalid.',
            'sea_service.*.ship_type_id.exists' => 'Selected ship type for a sea service entry is invalid.',
            'sea_service.*.sign_on.date_format' => 'Invalid sign-on date format for a sea-service entry (expected YYYY-MM-DD).',
            'sea_service.*.sign_off.date_format' => 'Invalid sign-off date format for a sea-service entry (expected YYYY-MM-DD).',
            'sea_service.*.grt_unit.in' => 'Tonnage unit must be either GRT or DWT.',
            'sea_service.*.grt_value.numeric' => 'Tonnage value must be numeric.',
            'sea_service.*.bhp.numeric' => 'BHP must be numeric.',
        ];
    }
}
