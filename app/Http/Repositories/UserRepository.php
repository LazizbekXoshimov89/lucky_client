<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\UserInterface;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserInterface
{
    public function __construct(
        private User $user,
        private Hash $hash,
    ) {}

    public function login(UserLoginRequest $request)
    {
        if (strlen($request->username) == 0 || strlen($request->password) == 0)
             return 'error';

         $user = $this->user::where('username', $request->get('username'))->first();
         if (!$user)
             return response()->json(['message' => 'Login yoki Parol noto\'g\'ri'], 400);
         if (!$this->hash::check($request->get('password'), $user->password))
             return response()->json(['message' => 'Login yoki Parol noto\'g\'ri'], 400);

         $token = $user->createToken('auth-token')->plainTextToken;

         $this->user::where('id', $user->id)->update([
             "remember_token" => $token,
         ]);

         return response()->json(["token" => "$token"], 201);
    }
}
