<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string|unique:users,username',
            'name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $user->profile()->create([
            'name' => $fields['name'],
            'mobile' => $fields['mobile']
        ]);

        $user->assignRole('User');

        $token = $user->createToken($request->userAgent())->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function signin(Request $request)
    {

        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('email', $fields['username'])->orWhere('username', $fields['username'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Invalid signin'
            ], 401);
        } else {

            $user->tokens()->delete();

            $token = $user->createToken($request->userAgent())->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return response($response, 201);
        }
    }

    public function logout()
    {
        $this->user->tokens()->delete();
        return [
            'message' => 'Logged out',
        ];
    }
}
