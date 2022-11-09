<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {

        //     $user = Admins::whereEmail($request->email)->first();
        //     return [
        //         'username' => $user->username,
        //         'token' => $user->api_token,
        //         'email' => $user->email,
        //         'id' => $user->id,
        //     ];
        // }
        $password = $request->password;
        $user = Admins::where(['email' => $request->email])->first();
 
        if ( isset($user) && Hash::check($password, $user->password)) {

            return [
                'username' => $user->username,
                'token' => $user->api_token,
                'email' => $user->email,
                'id' => $user->id,
            ];
        }
        return ['success' => false];
    }

    public function register(Request $request){
        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
        ]);
        return Admins::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),

        ]);
    }

    public function signout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
