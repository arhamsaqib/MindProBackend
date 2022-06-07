<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContestantStatisticsController extends Controller
{
    public function getStatisticsForJudge(Request $request){

        $jid = $request->judge_id;
        $cid = $request->contestant_id;

        $totalwords = DB::table('contestant_attempts')->whereCid($cid)
        ->join('words', 'words.id', '=', 'contestant_attempts.word_id')
        ->where('words.judge_id','=',$jid)
        ->count();
        $right = DB::table('contestant_attempts')->whereCid($cid)
        ->where('contestant_attempts.score','>=',5)
        ->join('words', 'words.id', '=', 'contestant_attempts.word_id')
        ->where('words.judge_id','=',$jid)
        ->count();
        $totalJudges = DB::table('contestant_attempts')->whereCid($cid)
        ->join('words', 'words.id', '=', 'contestant_attempts.word_id')
        ->distinct('words.judge_id')
        ->count();
        $rating = DB::table('contestant_attempts')->whereCid($cid)
        ->join('words','words.id','=','contestant_attempts.word_id')
        ->where('words.judge_id','=',$jid)
        ->avg('contestant_attempts.score');

        $data = [
            'totalWords' => $totalwords,
            'rightWords' => $right,
            'totalJudges' => $totalJudges,
            'rating' => $rating
        ];
        
        return $data;
    }
    public function getStatisticsGlobal(Request $request){
        $cid = $request->contestant_id;

        $totalwords = DB::table('contestant_attempts')->whereCid($cid)
        ->join('words', 'words.id', '=', 'contestant_attempts.word_id')
        ->count();

        $right = DB::table('contestant_attempts')->whereCid($cid)
        ->where('contestant_attempts.score','>=',5)
        ->join('words', 'words.id', '=', 'contestant_attempts.word_id')
        ->count();

        $totalJudges = DB::table('contestant_attempts')->whereCid($cid)
        ->join('words', 'words.id', '=', 'contestant_attempts.word_id')
        ->distinct('words.judge_id')
        ->count();
        $rating = DB::table('contestant_attempts')->whereCid($cid)
        ->join('words','words.id','=','contestant_attempts.word_id')
        ->avg('contestant_attempts.score');

        $data = [
            'totalWords' => $totalwords,
            'rightWords' => $right,
            'totalJudges' => $totalJudges,
            'rating' => $rating
        ];
        
        return $data;
    }
}
