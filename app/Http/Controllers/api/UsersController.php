<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

use App\Http\Requests\UserLoginRequest;

class UsersController extends Controller
{
    public function index(){
        return User::all();
    }

    public function currentUser(){
        return Auth::user();
    }
}
