<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class UserController extends Controller
{
    public function logout(Request $request){
        $user = Auth::user();
        $user->api_key = '';
        $user->save();
        return $user;
    }
}
