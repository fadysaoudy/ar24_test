<?php

namespace App\Http\Requests\DTO\Attachment;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Spatie\LaravelData\Attributes\Validation\File;
use Spatie\LaravelData\Attributes\Validation\Mimes;
use Spatie\LaravelData\Data;

class AttachmentUploadRequest extends Data
{
    /**
     * @param string|null $token
     * @param string|null $date
     * @param string|null $id_user
     * @param $file
     */

    public function __construct(

        public? string $token,
        public ?string $date,
        public ?string $id_user,
        #[File]
        #[Mimes('jpg', 'png', 'jpeg', 'pdf')]
        public $file,


    )
    {

        $this->id_user = config('ar24.ar24_user_id');
        $this->date = Carbon::now()->addHours(2)->format('Y-m-d H:i:s');
        $this->token = config('ar24.ar24_token');
    }

    public function toArray(): array
    {

        $data = parent::toArray();

        $data['id_user'] = $this->id_user;
        $data['date'] = $this->date;
        $data['token'] = $this->token;
        return $data;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public static function rules(): array
    {

        return [
            'file' => ['required', 'file','mimes:jpg,jpeg,png,pdf'],
        ];
    }
}
