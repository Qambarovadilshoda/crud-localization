<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->success(new UserResource($user), 'success.user-created', 201);
    }
    public function login(LoginRequest $request){
        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('login')->plainTextToken;
        return $this->success($token, __('success.user-logged'));
    }
    public function getUser(Request $request){
        return $this->success(new UserResource($request->user()));
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return $this->success([], __('success.user-logged_out'), 204);
    }
}
