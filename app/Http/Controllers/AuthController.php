<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\hash;
use App\Models\Users;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
                'name' => 'required|string',
                'email' => 'required|string|unique:users,email',
                'password' => 'required|string|confirmed'
        ]);

        $user = Users::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('laraveTest')->plainTextToken;
        $reponse = [
            'user' => $user,
            'token' => $token
        ];
        return response($reponse,201);
    }
    public function login(Request $request)
    {
        $fields = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
        ]);

        //check email
        $user = Users::where('email','=',$fields['email'])->first();

        //Check pass
        if(!$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message' => 'Bad Creds'
            ],401);
        }
        $token = $user->createToken('laraveTest')->plainTextToken;
        $reponse = [
            'user' => $user,
            'token' => $token
        ];
        return response($reponse,201);
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
