<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' =>'required|string|min:3',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',
        ]);

        $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
                'api_token' => Str::random(60),
        ]);
        return response()->json(['token'=>$user->api_token],201);
    }


    public function login(Request $request){
        $request->validate([
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',
        ]);
        $user = User::where('email',$request->email)->first();
        if (!$user || !Hash::check($request->password,$user->password)){
            return response()->json(['message'=>'Unauthorized'],401);
        }
        $user->api_token = Str::random(60);
        $user->save();
        return response()->json(['token'=>$user->api_token],200);
    }
}
