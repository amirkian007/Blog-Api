<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        if (!Auth::attempt($request)) {
            return $this->error('User Not Found!', 401);
        }

        $user = User::where('email', $request['email'])->first();

        $response = array(
            'user' => $user,
            'token' => $user->createToken('tokens')->plainTextToken,
        );

        return response($response, 201);
    }
}
