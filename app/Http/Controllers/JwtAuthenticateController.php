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
        
        $role = new Role();
        $role->name = $request->input('name');
        $role->save();

        return response()->json("created ".$role->name." role successfully");      
    }

    public function createPermission(Request $request){
        
        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->save();

        return response()->json("created ".$permission->name." permission successfully");       
    }

    public function assignRole(Request $request){
        
        $user = User::where('email', '=', $request->input('email'))->first();

        $role = Role::where('name', '=', $request->input('role'))->first();
        //$user->attachRole($request->input('role'));
        $user->roles()->attach($role->id);

        return response()->json("created");
    }

    public function attachPermission(Request $request){
        
        $role = Role::where('name', '=', $request->input('role'))->first();
        $permission = Permission::where('name', '=', $request->input('name'))->first();
        $role->attachPermission($permission);

        return response()->json("created");
    }
}
