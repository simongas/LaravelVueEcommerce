<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;

class UsersController extends Controller
{
    public function index(){
        return User::all();
    }

    public function currentUser(){
        return Auth::user();
    }

    public function store(UserCreateRequest $request){
        if($request->validated()){
            User::create($request->all());
        }
        return User::all();
    }

    public function update(UserCreateRequest $request){
        if($request->validated()){
            User::find($request->id)->fill($request->all())->save();
        }
        return User::all();
    }

    public function delete($id = 0){
        if($id > 0){
            User::find($id)->delete();
        }
        return User::all();
    }
}
