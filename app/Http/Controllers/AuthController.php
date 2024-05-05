<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = User::find(Auth::user()->id);
            $user_token = $user->createToken('appToken')->accessToken;
            return response()->json([
                'user' => $user,
                'token' => $user_token
            ]);
        }else{
            return response('', 401);
        }
    }

    
   
}
