<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contestants;
use Illuminate\Support\Facades\DB;


class ContestantController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'uid' => 'required|string',
        ]);

        $new= Contestants::create(
            [
                'uid' => $request->uid,
            ]);
        return $new;
    }
    public function show($id){
        $user = Contestants::whereUid($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Contestants::all();
        return $user;
    }
    public function destroy($id){
        $user = Contestants::where('uid', $id)->delete();
        return $user;
    }

    public function contestantBasicInfo(){
        $res = DB::table('Contestants')
        ->join('Basic_Information','Contestants.uid','=','Basic_Information.uid')
        ->select('Contestants.*','Basic_Information.*')
        ->get();

        if(isset($res)){
            return $res;
        }else{
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }
    }

}
