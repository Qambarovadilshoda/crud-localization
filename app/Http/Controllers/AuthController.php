<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->success($user, __( 'success.created'), 201);
    }
    public function login(LoginRequest $request){
        $user = User::where('email', $request->email)->first();
        if(!$user){
            return $this->error(__('error.no'), 404);
        }
        $token = $user->createToken('login')->plainTextToken;
        return $this->success($token, __('success.logged'));
    }
    public function getUser(){
        return $this->success(request()->user());
    }
    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return $this->success([], __('success.logged_out'), 204);
    }
}
