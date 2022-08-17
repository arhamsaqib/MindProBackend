<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labels;

class LabelDetailsController extends Controller
{
    public function judgeSpecificLabelDetails(Request $request){

        $jid = $request->judge_id;
        $cid = $request->contestant_id;
        $label = $request->label;
        
        $res = Labels::whereUid($cid)->whereLabel($label)
        ->join('contestant_attempts', 'labels.attempt_id', '=', 'contestant_attempts.id')
        ->join('words', 'contestant_attempts.word_id', '=', 'words.id')
        ->where('words.judge_id','=',$jid)
        ->get();

        return $res;
    }
    public function globalLabelDetails(Request $request){
        
        $cid = $request->contestant_id;
        $label = $request->label;
        
        $res = Labels::whereUid($cid)->whereLabel($label)
        ->join('contestant_attempts', 'labels.attempt_id', '=', 'contestant_attempts.id')
        ->join('words', 'contestant_attempts.word_id', '=', 'words.id')
        ->get();

        return $res;
    }
}
