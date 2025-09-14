<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CandidateRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // adjust if needed (e.g. only admins allowed)
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            // user credentials
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',

            // profile / personal fields
            'first_name' => 'required|string|max:100',
            'middle_name' => 'nullable|string|max:100',
            'last_name' => 'required|string|max:100',
            'marital_status' => 'nullable|in:single,married,divorced,widowed',
            'dob' => 'nullable|date',
            'mobile_cc' => 'nullable|string|max:6',
            'mobile_number' => 'required|string|max:30',
            'whatsapp_cc' => 'nullable|string|max:6',
            'whatsapp_number' => 'nullable|string|max:30',
            'address' => 'nullable|string',
            'profile_pic' => 'nullable|file|image|max:2048',
            'gender' => 'nullable|in:male,female,other',
            'nationality' => 'nullable|string|max:100',
            'state_id' => 'nullable|integer|exists:states,id',
            'city_id' => 'nullable|integer|exists:cities,id',

            // resume fields
            'present_rank' => 'nullable|integer|exists:ranks,id',
            'present_rank_exp' => 'nullable|string|max:50',
            'post_applied_for' => 'nullable|integer|exists:ranks,id',
            'date_of_availability' => 'nullable|date',
            'indos_number' => 'nullable|string|max:100',
            'passport_nationality' => 'nullable|string|max:100',
            'passport_number' => 'nullable|string|max:100',
            'passport_expiry' => 'nullable|date',
            'usa_visa' => 'nullable|in:yes,no',
            'cdc_nationality' => 'nullable|string|max:100',
            'cdc_no' => 'nullable|string|max:100',
            'cdc_expiry' => 'nullable|date',
            'presea_training_type' => 'nullable|string|max:255',
            'presea_training_issue_date' => 'nullable|date',
            'coc_held' => 'nullable|in:yes,no',
            'coc_no' => 'nullable|string|max:100',
            'coc_type' => 'nullable|string|max:100',
            'coc_date_of_expiry' => 'nullable|date',
            'additional_information' => 'nullable|string',

            // courses - multi select (master ids)
            'courses' => 'nullable|array',
            'courses.*' => 'integer|exists:course_certificates,id',

            // dce endorsements arrays
            'dce_id' => 'nullable|array',
            'dce_id.*' => 'integer|exists:dce_endorsements,id',
            'dce_validity' => 'nullable|array',
            'dce_validity.*' => 'nullable|date',

            // sea service entries => array of objects
            'sea_service' => 'nullable|array',
            'sea_service.*.rank_id' => 'nullable|integer|exists:ranks,id',
            'sea_service.*.ship_type_id' => 'nullable|integer|exists:ship_types,id',
            'sea_service.*.sign_on' => 'nullable|date',
            'sea_service.*.sign_off' => 'nullable|date',
            'sea_service.*.company_name' => 'nullable|string|max:255',
            'sea_service.*.ship_name' => 'nullable|string|max:255',
            'sea_service.*.grt' => 'nullable|string|max:50',
            'sea_service.*.bhp' => 'nullable|string|max:50',
            'sea_service.*.tonnage' => 'nullable|string|max:50',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email address already in use.',
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }

    /**
     * Prepare the validated data by normalizing some inputs if necessary.
     */
    protected function prepareForValidation(): void
    {
        // Example: strip spaces from mobile dial codes
        if ($this->has('mobile_cc')) {
            $this->merge(['mobile_cc' => trim($this->input('mobile_cc'))]);
        }
        if ($this->has('whatsapp_cc')) {
            $this->merge(['whatsapp_cc' => trim($this->input('whatsapp_cc'))]);
        }
    }
}
