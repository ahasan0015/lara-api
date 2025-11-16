<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    function register(Request $request){
        $request->validate([
            'name'=>'required|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed'
        ]);

        $user =User::create($request->all());

        return response()->json([
            'success'=>true,
            'data'=>$user
        ],201);

    }

    function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user = User::where('email', $request->email)->first();

        if(!$user){
            return response()->json([
                'error'=>true,
                'message'=> 'Email does not existes'
            ],401);
        }else{
            if(Hash::check($request->password, $user->password)){
                $token = $user->createToken('api')->plainTextToken;
                return response()->json([
                    'success'=>true,
                    'data'=> $user,
                    'token' => $token
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=> 'password does not match'
                ],401);
            }
        }

    }
    public function logout(Request $request){
        // auth()->User->currentAccessToken()->delete();
        auth()->user()->tokens()->delete();
        return response()->json([
            'success'=> true,
            'message'=>'Logout successfully'
        ]);
    }
}
