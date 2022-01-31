<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Judges;
use App\Models\Contestants;


class UserAllDetailsController extends Controller
{
    public function store(Request $request){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 403);
    }
    public function show($id){

        //$user = User::find($id);
        $user = User::whereFuid($id)->first();
        if(isset($user)){
            $id = $user->id;
            $j = Judges::whereUid($id)->first();
            $u = Contestants::whereUid($id)->first();
            $new1 = [
                "id"=> $id,
                "judge_id"=> $j->id,
                "contestant_id"=> $u->id,
                "username"=> $user->username,
                "email"=> $user->email,
                "status"=> $user->status,
            ];
            return $new1;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 403);
    }
    public function destroy($id){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 403);
    }
}
