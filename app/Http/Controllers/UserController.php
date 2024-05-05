<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profile(){
        $user = Auth::user();
        if($user){
            return response()->json($user);
        }
        return response('', 401);
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        if(!$user){
            return response('', 401);
        }
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id . ',id',
            'password' => 'nullable|min:8|max:50'
        ]);
        if($v->fails()){
            return response()->json($v->errors(), 400);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $result = $user->save();
        if(!$result){
            return response('', 500);
        }
        return response()->json($user, 201);
    }
}
