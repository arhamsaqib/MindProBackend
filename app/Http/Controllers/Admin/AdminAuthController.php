<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admins;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\AdminResource;


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
 
        if ( isset($user) && Hash::check($password, $user->password) && $user->status=='active') {

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

    public function authenticate(Request $request){
        $request->validate([
            'token' => 'required',
        ]);
        $user = Admins::where(['api_token' => $request->token])->first();

        if (isset($user)){
            return [
                'username' => $user->username,
                'token' => $user->api_token,
                'email' => $user->email,
                'id' => $user->id,
                'role' => $user->role,
                'status' => $user->status,
            ];
        }
        return ['success' => false];
    }

    public function index(){
        $admins =  Admins::all();
        return AdminResource::collection($admins);
    }

    public function addAdmin(Request $request){

        $data = $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:admins',
        ]);
        $pass = "12345678";
        return Admins::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($pass),
            'api_token' => Str::random(60),
            'role'      => 'admin',
            'status'      => 'active',
        ]);
    }

    public function updateAdmin(Request $request){
        
        $data = $request->validate([
            'username' => 'sometimes',
            'email' => 'sometimes',
            'password' => 'sometimes',
            'role' => 'sometimes',
            'status' => 'sometimes',
        ]);
        $admin=Admins::whereId($request->id)->first();

        if(!isset($admin)) return['success'=>false];

        $admin->update($data);
        return['success'=>true];
    }
    // public function updateAdmin($id, Request $request){
        
    //     $data = $request->validate([
    //         'username' => 'sometimes',
    //         'email' => 'sometimes',
    //         'password' => 'sometimes',
    //         'role' => 'sometimes',
    //         'status' => 'sometimes',
    //     ]);
    //     $admin=Admins::whereId($id)->first();

    //     if(!isset($admin)) return['success'=>false];

    //     $admin->update($data);
    //     return['success'=>true];
    // }
    // public function changeAdminStatus(Request $request){

    //     $data = $request->validate([
    //         'uid' => 'required',
    //         'status' => 'required',
    //     ]);

    //     $res=  Admins::where('id',$request->uid)->update(['status'=>$data['status']]);
    //     if($res) return['success'=>true];
    //     return['success'=>false];
    // }
}
