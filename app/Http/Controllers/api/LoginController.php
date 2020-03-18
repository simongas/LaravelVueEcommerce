<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\UserLoginRequest;

class LoginController extends Controller
{
    public function login(UserLoginRequest $request){
        $login = $request->validated();
        if(!Auth::attempt($login)){
            return response(['message' => 'Invalid Credentials.']);
        }
        
        $accessToken = Auth::user()->createToken('authToken')->accessToken;
        return response(['user' => Auth::user(), 'access_token' => $accessToken]);
    }
}
