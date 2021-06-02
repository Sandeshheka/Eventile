<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Mail\WelcomeEmail;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
   public function register(RegisterRequest $request)
   {
      $user= User::create($request->all());
     $mails= Mail::to($user->email)->queue(new WelcomeEmail($user->name));
      
     return response('Created', Response::HTTP_CREATED);   
   }
}
