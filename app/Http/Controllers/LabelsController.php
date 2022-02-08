<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labels;
use App\Models\Words;
use Illuminate\Support\Facades\DB;


class LabelsController extends Controller
{
    public function store(Request $request){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 405);
    }
    public function show($id){
        $user = Labels::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Labels::all();
        return $user;
    }
    public function destroy($id){
        $user = Labels::where('id', $id)->delete();
        return $user;
    }
    public function judgeSpecificLabels(Request $request){
        $jid = $request->judge_id;
        $cid = $request->contestant_id;
        $res = DB::table('words')->whereJudge_id($jid)
            ->join('contestant_attempts', 'words.id', '=', 'contestant_attempts.word_id')
            ->where('contestant_attempts.cid','=',$cid)
            ->join('labels', 'labels.attempt_id', '=', 'contestant_attempts.id')
            ->select('contestant_attempts.cid','words.judge_id','label')
            //->select('words.id', 'contestant_attempts.cid', 'contestant_attempts.time_taken','words.judge_id','label','labels.attempt_id')
            ->distinct('label')
            ->get();
        return $res;
    }
}
