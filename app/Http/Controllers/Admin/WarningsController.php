<?php

namespace App\Http\Controllers\Admin;
use App\Models\Warnings;
use App\Models\Words;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class WarningsController extends Controller
{
    public function postJudgeWarning(Request $request){
        $data = $request->validate([
            'jid'=>'required',
            'word_id'=>'required',
            'violation_type'=>'required',
        ]);
        $word = Words::whereId($data['word_id'])->first();
        $check = Str::contains($data['violation_type'], 'Word');
        if($check){
            $message="Warning! You posted an abusive word in the game. Your word is ".$word['word'].".";
        }
        else{
            $message="Warning! You used an abusive hint in the game. Your word is ".$word['word'].".";
        }
        $new= Warnings::create(
            [
                'uid' => $data['jid'],
                'message' => $message,
                'wid' => $data['word_id'],
            ]);
        return $new;
    }
}