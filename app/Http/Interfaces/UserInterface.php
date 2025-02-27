<?php

namespace App\Http\Interfaces;

use App\Http\Requests\UserLoginRequest;
interface UserInterface
{
    public function login(UserLoginRequest $request);
}
