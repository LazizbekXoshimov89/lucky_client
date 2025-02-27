<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function login(UserLoginRequest $request)
     {
         if (strlen($request->username) == 0 || strlen($request->password) == 0)
             return 'error';

         $user = User::where('username', $request->get('username'))->first();
         if (!$user)
             return response()->json(['message' => 'Login yoki Parol noto\'g\'ri'], 400);
         if (!Hash::check($request->get('password'), $user->password))
             return response()->json(['message' => 'Login yoki Parol noto\'g\'ri'], 400);

         $token = $user->createToken('auth-token')->plainTextToken;

         User::where('id', $user->id)->update([
             "remember_token" => $token,
         ]);

         return response()->json(["token" => "$token"], 201);
     }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
