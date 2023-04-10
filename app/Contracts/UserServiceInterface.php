<?php

namespace App\Contracts;

use App\Http\Requests\DTO\User\UserCreateRequest;
use App\Http\Requests\DTO\User\UserGetRequest;
use stdClass;

interface UserServiceInterface
{
    public function store(UserCreateRequest $request):void;
    public function get(UserGetRequest $request):stdClass;
}
