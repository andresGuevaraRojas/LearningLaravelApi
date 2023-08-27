<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    public function register(RegisterUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([         
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])
        ]);
    }

   
    public function login(LoginUserRequest $request)
    {
        $credentials = $request->validated();
      

        if(!Auth::attempt($credentials)){
            return response()->json(['message'=>'Unauthorized'],401);
        }

        $token = $request->user()->createToken('auth_token');

        return  ['token' => $token->plainTextToken];
    }


    public function logout(Request $request)
    {        
        $request->user()->currentAccessToken()->delete();
    }

}
