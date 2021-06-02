<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $user->createToken('web')->plainTextToken;
    }

    public function logout()
    {
        
        auth()->user()->tokens()->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function redirectToProvider()
    {
   
        return Socialite::driver('github')->stateless()->redirect()->getTargetUrl();
    }

    public function handleProviderCallback()
    {
        $user= Socialite::driver('github')->stateless()->user();

        $email= $user->getEmail();
  
        $user = User::whereEmail($email)->first();
      
      
        if ($user) {
          
            return $user->createToken('web')->plainTextToken;
        }
        else{
            return response(null, Response::HTTP_NOT_FOUND);
        }
    }
}
