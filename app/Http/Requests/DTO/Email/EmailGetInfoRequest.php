<?php

namespace App\Http\Requests\DTO\Email;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\Data;

class EmailGetInfoRequest extends Data
{

    public function __construct(
        public ?string $id,
        public ?string $date,
        public ?string $token,
    )
    {

        $this->date = Carbon::now()->addHours(2)->format('Y-m-d H:i:s');
        $this->token = config('ar24.ar24_token');
        $this->id = config('ar24.ar24_test_mail');

    }

    public function toArray(): array
    {
        $data = parent::toArray();

        $data['date'] = $this->date;
        $data['token'] = $this->token;
        $data['id'] = $this->id;

        return $data;
    }
    public static function rules(): array
    {
        return [
            //
        ];
    }
}
