<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    public function auth(Request $request)
    {
        $request->validate([
            'email'	=> 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        // dd($user, $request->all());
        if(!$user || !Hash::check($request->password, $user->password)){
            return response()->json(["message" => "email_or_password_invalid"], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json(["access_token" => $user->createToken('token-login')->plainTextToken], Response::HTTP_CREATED);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
