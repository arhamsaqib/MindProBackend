<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Judges;
use Illuminate\Support\Facades\DB;


class JudgeController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'uid' => 'required|string',
        ]);

        $new= Judges::create(
            [
                'uid' => $request->uid,
            ]);
        return $new;
    }
    public function show($id){
        $user = Judges::whereUid($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Judges::all();
        return $user;
    }
    public function destroy($id){
        $user = Judges::where('uid', $id)->delete();
        return $user;
    }
    public function judgeBasicInfo(){
        $res = DB::table('Judges')
        ->join('Basic_Information','Judges.uid','=','Basic_Information.uid')
        ->select('Judges.*','Basic_Information.*')
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
