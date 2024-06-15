<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    use ApiResponse;

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            throw ValidationException::withMessages(['email' => ['Credentials doesn\'t match with our records']]);
        }

        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages(['email' => ['Credential or password is not matched']]);
        }
        $userToken = auth()->guard('api')->login($user);
        $request->merge([
            'jwt_token' => $userToken
        ]);

        return $this->successResponse(
            'You are successfully logged in',
            ['token' => $userToken]
        );
    }

    public function register(RegisterRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $this->successResponse(
            'Register success, please login',
        );
    }

    public function logout()
    {
        auth()->guard('api')->logout();
        return $this->successResponse('Successfully logged out');
    }
}
