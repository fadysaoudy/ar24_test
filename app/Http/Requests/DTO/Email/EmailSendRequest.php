<?php

namespace App\Http\Requests\DTO\Email;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class EmailSendRequest extends Data
{
    public function __construct(
        public? string $token,
        public ?string $id_user,
        public bool    $eidas,
        public ?string  $custom_name_sender,
        public ?string  $to_firstname,
        public ?string  $to_lastname,
        public ?string  $to_company,
        public string  $to_email,
        public string  $dest_statut,
        public string  $content,
        public ?string  $ref_dossier,
        public ?string  $ref_client,
        public ?string  $ref_facturation,
        public ?string  $payment_slug,
        public ?string $webhook,
        public ?bool $pre_notif,
        public ?string $date,
        public $attachment = null,


    )
    {
        $this->id_user = config('ar24.ar24_user_id');
        $this->date = Carbon::now()->addHours(2)->format('Y-m-d H:i:s');
        if ($attachment !== null) {
            $this->attachment = array_map('intval', explode(',', $attachment));
        }
        $this->token = config('ar24.ar24_token');

    }

    public function toArray(): array
    {

        $data = parent::toArray();

        $data['date'] = $this->date;
        $data['token'] = $this->token;
        $data['id_user'] = $this->id_user;
        return $data;
    }

    public static function rules(): array
    {
        return [
            'eidas' => ['bool','required'],
            'custom_name_sender' => ['nullable','string'],
            'to_firstname' => ['string', 'required_unless:dest_statut,professionnel',],
            'to_lastname' => ['string', 'required_unless:dest_statut,professionnel',],
            'to_company' => ['string', 'required_unless:dest_statut,professionnel',],
            'to_email' => ['email', 'required',],
            'dest_statut' => ['string', 'required',],
            'content' =>  [
                'required',
                function ($attribute, $value, $fail) {
                    // Check that the value is a string
                    if (!is_string($value)) {
                        $fail("The $attribute field must be a string.");
                        return;
                    }

                    // Check that the value contains only plain text or HTML (with base64-encoded images)
                    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $value) &&
                        !preg_match('/<img.*?src="data:image\/[^;]+;base64,[^"]+".*?>/i', $value) &&
                        preg_match('/<[^>]*>/', $value) !== 0) {
                        $fail("The $attribute field must contain only plain text or HTML, and no external resources except for base64-encoded images.");
                        return;
                    }
                }
            ],
            'ref_dossier' => ['string', 'nullable',],
            'ref_client' => ['string', 'nullable',],
            'ref_facturation' => ['string', 'nullable',],
            'attachment' => [
                'nullable',
                'string',
                'distinct',
                'max:100',
                function ($attribute, $value, $fail) {
                    $attachmentIds =  explode(',', $value);
                    $result = [];
                    foreach ($attachmentIds as $key => $id) {
                        if (!is_numeric($id)) {
                            $fail($attribute . ' contains a non-numeric value.');
                            return 0;
                        }
                        $result["attachment[$key]"] = $id;
                    }
                    return $result;
                }
            ],
            'payment_slug' => ['string', 'nullable',],
            'webhook' => ['nullable', 'url'],
            'pre_notif' => ['boolean'],

        ];
    }
}
