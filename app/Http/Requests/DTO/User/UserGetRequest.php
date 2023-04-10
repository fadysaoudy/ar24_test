<?php

namespace App\Http\Requests\DTO\User;

use Carbon\Carbon;
use Spatie\LaravelData\Data;

class UserGetRequest extends Data
{
    /**
     * @param string|null $user_id
     * @param string|null $email
     * @param string|null $date
     * @param string|null $token
     */
    public function __construct(
        public ?string $user_id,
        public ?string $email,
        public ?string $date,
        public ?string $token,
    )
    {

        $this->date = Carbon::now()->addHours(2)->format('Y-m-d H:i:s');
        $this->token = config('ar24.ar24_token');

    }

    public function toArray(): array
    {
        $data = parent::toArray();

        $data['date'] = $this->date;
        $data['token'] = $this->token;

        return $data;
    }

    public static function rules(): array
    {
        return [
            'user_id' => ['required_if:email,null'],
            'email' => ['required_if:user_id,null', 'email'],
        ];
    }

    public static function messages(): array
    {
        return [
            'user_id.required_if' => __('The User Id is required if the email is null'),
            'email.required_if' => __('The Email is required if the User Id is null.'),
            'email.email' => __('The Email is not a valid Email.'),

        ];
    }
}
