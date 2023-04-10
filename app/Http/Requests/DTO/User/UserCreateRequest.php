<?php

namespace App\Http\Requests\DTO\User;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class UserCreateRequest  extends Data
{
    /**
     * @param string|null $token
     * @param string|null $date
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $country
     * @param string $address1
     * @param string $statut
     * @param string $company
     * @param string $city
     * @param string $zipcode
     * @param string $gender
     * @param string $password
     * @param string|null $company_siret
     * @param string|null $company_tva
     * @param string|null $address2
     * @param bool $confirmed
     * @param string|null $billing_email
     * @param bool $notify_ev
     * @param bool $notify_ar
     * @param bool $notify_ng
     * @param bool $notify_consent
     * @param bool $notify_eidas_to_valid
     * @param bool $notify_recipient_update
     * @param bool $notify_waiting_ar_answer
     * @param bool $is_legal_entity
     */
    public function __construct(
        public ?string $token,
        public ?string $date,
        public string $firstname,
        public string $lastname,
        public string $email,
        public string $country,
        public string $address1,
        public string $statut,
        public string $company,
        public string $city,
        public string $zipcode,
        public string $gender,
        public string $password,
        public ?string $company_siret,
        public ?string $company_tva,
        public ?string $address2,
        public bool $confirmed,
        public ?string $billing_email,
        public bool $notify_ev,
        public bool $notify_ar,
        public bool $notify_ng,
        public bool $notify_consent,
        public bool $notify_eidas_to_valid,
        public bool $notify_recipient_update,
        public bool $notify_waiting_ar_answer,
        public bool $is_legal_entity,
    ) {
        $this->token = config('ar24.ar24_token');
        $this->date = Carbon::now()->addHours(2)->format('Y-m-d H:i:s');
    }

    public function toArray(): array
    {

        $data = parent::toArray();

        $data['token'] = $this->token;
        $data['date'] = $this->date;
        return $data;
    }


    public static function rules(): array
    {

        return [
            'firstname' => ['required', 'string'],
            'lastname' => ['required', 'string'],
            'email' => ['required', 'email'],
            'country' => ['required', 'string'],
            'address1' => ['required', 'string'],
            'statut' => ['required', 'string'],
            'company' => ['required', 'string'],
            'city' => ['required', 'string'],
            'zipcode' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'password' => ['required', 'string','min:8'],
            'company_siret' => ['nullable', 'numeric'],
            'company_tva' => ['nullable', 'string'],
            'address2' => ['nullable', 'string'],
            'confirmed' => ['required', 'boolean'],
            'billing_email' => ['nullable', 'email'],
            'notify_ev' => ['required', 'boolean'],
            'notify_ar' => ['required', 'boolean'],
            'notify_ng' => ['required', 'boolean'],
            'notify_consent' => ['required', 'boolean'],
            'notify_eidas_to_valid' => ['required', 'boolean'],
            'notify_recipient_update' => ['required', 'boolean'],
            'notify_waiting_ar_answer' => ['required', 'boolean'],
            'is_legal_entity' => ['required', 'boolean']
        ];
    }
    public static function messages(): array
    {
        return [
            'firstname.required' => __('The First Name field is required.'),
            'firstname.string' => __('The First Name field must be a string.'),
            'lastname.required' => __('The Last Name field is required.'),
            'lastname.string' => __('The Last Name field must be a string.'),
            'email.required' => __('The Email field is required.'),
            'email.email' => __('The Email field must be a valid email address.'),
            'country.required' => __('The Country field is required.'),
            'country.string' => __('The Country field must be a string.'),
            'address1.required' => __('The Address field is required.'),
            'address1.string' => __('The Address field must be a string.'),
            'statut.required' => __('The Statut field is required.'),
            'statut.string' => __('The Statut field must be a string.'),
            'company.required' => __('The Company field is required.'),
            'company.string' => __('The Company field must be a string.'),
            'city.required' => __('The City field is required.'),
            'city.string' => __('The City field must be a string.'),
            'zipcode.required' => __('The Zipcode field is required.'),
            'zipcode.string' => __('The Zipcode field must be a string.'),
            'gender.required' => __('The Gender field is required.'),
            'gender.string' => __('The Gender field must be a string.'),
            'password.required' => __('The Password field is required.'),
            'password.string' => __('The Password field must be a string.'),
            'password.min' => __('The Password field must be at least :min characters.'),
            'company_siret.numeric' => __('The Company Siret field must be a number.'),
            'company_tva.string' => __('The Company TVA field must be a string.'),
            'address2.string' => __('The Address 2 field must be a string.'),
            'billing_email.email' => __('The Billing Email field must be a valid email address.'),
            'notify_ev.required' => __('The Notify EV field is required.'),
            'notify_ev.boolean' => __('The Notify EV field must be a boolean.'),
            'notify_ar.required' => __('The Notify AR field is required.'),
            'notify_ar.boolean' => __('The Notify AR field must be a boolean.'),
            'notify_ng.required' => __('The Notify NG field is required.'),
            'notify_ng.boolean' => __('The Notify NG field must be a boolean.'),
            'notify_consent.required' => __('The Notify Consent field is required.'),
            'notify_consent.boolean' => __('The Notify Consent field must be a boolean.'),
            'notify_eidas_to_valid.required' => __('The Notify eIDAS To Valid field is required.'),
            'notify_eidas_to_valid.boolean' => __('The Notify eIDAS To Valid field must be a boolean.'),
            'notify_recipient_update.required' => __('The Notify Recipient Update field is required.'),
            'notify_recipient_update.boolean' => __('The Notify Recipient Update field must be a boolean.'),
            'notify_waiting_ar_answer.required' => __('The Notify Waiting AR Answer field is required.'),
            'notify_waiting_ar_answer.boolean' => __('The Notify Waiting AR Answer field must be a boolean.'),
            'is_legal_entity.required' => __('The Legal Entity field is required.'),
            'is_legal_entity.boolean' => __('The Legal Entity field must be a boolean.'),
        ];
    }
}
