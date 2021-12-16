<?php

namespace App\Http\Controllers\api\v1;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Facade\FlareClient\Http\Response;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $response = array(
            'user' => $user,
            'token' => $user->createToken('tokens')->plainTextToken,
        );

        return response($response, 201);
    }

    public function login(LoginRequest $request)
    {

        $user = User::where('email', $request->email)->first();

        if (!$user && !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Bad Request'
            ], 401);
        }

        $response = array(
            'user' => $user,
            'token' => $user->createToken('tokens')->plainTextToken,
        );

        return response($response, 201);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            "message" => "logout",
        ];
    }
}
