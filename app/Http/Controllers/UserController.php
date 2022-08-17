<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'fuid' => 'required|string|min:8',
            'status' => 'sometimes|string',
        ]);

        $new= User::create([
            'username' => $request->username,
            'email' => $request->email,
            'fuid' => $request->fuid,
            'status' => $request->status,
        ]);
        return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = User::whereFuid($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = User::all();
        return $user;
    }
    public function destroy($id){
        $user = User::where('id', $id)->delete();
        return $user;
    }
}
