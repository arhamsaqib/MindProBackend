<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerformersController extends Controller
{
    public function getJudgePerformers($id){
        $res = DB::table('words')->whereJudge_id($id)
        ->join('contestant_attempts', 'words.id', '=', 'contestant_attempts.word_id')
        ->join('contestants', 'contestant_attempts.cid', '=', 'contestants.uid')
        ->join('users', 'users.id', '=', 'contestants.uid')
        ->select('contestant_attempts.cid','words.judge_id','users.username')
        ->distinct('users.username')
        ->get();
        return $res;
    }
    public function getJudgeTopPerformers($id){
        $tscore='5';
        $res = DB::table('words')->whereJudge_id($id)
        ->join('contestant_attempts', 'words.id', '=', 'contestant_attempts.word_id')
        ->where('contestant_attempts.score','=',$tscore)
        ->join('contestants', 'contestant_attempts.cid', '=', 'contestants.uid')
        ->join('users', 'users.id', '=', 'contestants.uid')
        ->select('contestant_attempts.cid','words.judge_id','users.username')
        ->distinct('users.username')
        ->get();
        return $res;
    }
    public function wordTopPerformers($id){
        $tscore='5';
        $res = DB::table('contestant_attempts')->whereWord_id($id)
        ->join('contestants', 'contestants.id', '=', 'contestant_attempts.cid')
        ->join('users', 'contestants.uid', '=', 'users.id')
        ->where('contestant_attempts.score','=',$tscore)
        ->select('contestant_attempts.cid','contestant_attempts.score','users.username')
        ->distinct('users.username')
        ->get();
        return $res;
    }
}
