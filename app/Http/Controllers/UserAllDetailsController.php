<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Judges;
use App\Models\Contestants;
use Illuminate\Support\Collection;


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
    public function judgeAllDetails($id){
        $j = Judges::whereId($id)->first();
        if(isset($j)){
            $uid =  $j->uid;
               $user = User::whereId($uid)->first();
                if(isset($user)){
                   return $user;
                }
                else{
                    return response()->json([
                        'message' => 'User connected to judge not found.'
                    ], 404);
                }
        }
        else{
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }
    }
    public function contestantAllDetails($id){
        $j = Contestants::whereId($id)->first();
        if(isset($j)){
            $uid =  $j->uid;
               $user = User::whereId($uid)->first();
                if(isset($user)){
                   return $user;
                }
                else{
                    return response()->json([
                        'message' => 'User connected to contestant not found.'
                    ], 404);
                }
        }
        else{
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }
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

    // Added

    public function judgeCount(){
        $res = Judges::count();

        if(isset($res))
        {
            // return $res;
            // return response()->json([$res , 200]);
            $check = [ 'count' => $res ];
            return $check;
        }else{
            return response()->json([
                'message' => 'Error Counting'
            ], 403);
        }
    }
    public function contestantCount(){
        $res = Contestants::count();
        if(isset($res))
        {
            return $res;
        }else{
            return 'Error Counting';
        }
    }
}
