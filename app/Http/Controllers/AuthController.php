<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\ResponseMessage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            "first_name" => "required|string",
            "last_name" => "required|string",
            "code" => "required|string|unique:users,code",
            "phone" => "required|string",
            "username" => "required|string|unique:users,username",
            "email" => "required|string|unique:users,email",
            "password" => "required|string|confirmed"
        ]);

        $user = User::create([
            "first_name" => $fields["first_name"],
            "last_name" => $fields["last_name"],
            "phone" => $fields["phone"],
            "username" => $fields["username"],
            "code"  => $fields["code"],
            "email" => $fields["email"],
            "password" => bcrypt($fields["password"])
        ]);

        $token = $user->createToken("myapptoken")->plainTextToken;

        $response = [
            "user" => $user, 
            "token" => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        $fields = $request->validate([
            "username" => "required|string",
            "password" => "required|string"
        ]);

        //Email
        $user = User::where("email", $fields["username"])
                    ->orWhere("username", $fields["username"])
                    ->first();

        //Password
        if (!$user || !Hash::check($fields["password"], $user->password))
            return response([
                "error" => ResponseMessage::ERROR_INVALID_PASSWORD_OR_USERNAME
            ], 401);

        $token = $user->createToken("myapptoken")->plainTextToken;

        $response = [
            "user" => $user, 
            "token" => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return response([
            "message" => ResponseMessage::SUCCESS_LOGOUT
        ], 200);
    }
}
