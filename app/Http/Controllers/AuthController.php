<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ]);
        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->api_key = Str::random(32);
        $user->role = 'user';
        $user->save();
        return $user;
    }
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        
        $user = User::where('email', $email)->first();

        if(!empty($user)){
            if(Hash::check($password, $user->password)){
                $user->api_key = Str::random(32);
                $user->save();
                return $user;
            }else{
                return response('Wrong Password.', 401);
            }
        }else{
            return response('Wrong Email.', 401);
        }
    }
}
