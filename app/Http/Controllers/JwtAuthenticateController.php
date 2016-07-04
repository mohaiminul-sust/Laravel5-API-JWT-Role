<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Log;

class JwtAuthenticateController extends Controller
{
    public function index(){

        return response()->json(['auth'=>Auth::user(), 'users'=>User::all()]);
    }

    public function authenticate(Request $request){

        $credentials = $request->only('email', 'password');

        // verify cred and create token
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    public function createRole(Request $request){
        // Todo       
    }

    public function createPermission(Request $request){
        // Todo       
    }

    public function assignRole(Request $request){
         // Todo
    }

    public function attachPermission(Request $request){
        // Todo       
    }
}
