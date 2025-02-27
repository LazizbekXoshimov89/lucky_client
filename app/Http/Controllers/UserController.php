<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\UserInterface;
use App\Http\Requests\UserLoginRequest;


class UserController extends Controller
{
    public function __construct(
        private UserInterface $userRepository
    )
    {}

     public function login(UserLoginRequest $request)
     {
        return $this->userRepository->login($request);
     }


}
