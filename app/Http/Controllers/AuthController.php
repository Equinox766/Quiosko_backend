<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistroRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(RegistroRequest $request)
    {
        $data = $request->validated();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        //Revisa las credenciales
        if (!Auth::attempt($data))
        {
            return response([
               'errors' => ['El email o la contraseña son invalidas!']
            ], 422);
        }

        //Authentication
        $user = Auth::user();

        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];

    }
    public function logout(Request $request)
    {

    }
}
