<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Words;


class JudgeWordsController extends Controller
{
    
    public function store(Request $request){
        $request->validate([
            'judge_id' => 'required|string',
            'hint1' => 'required|string',
            'hint2' => 'required|string',
            'hint3' => 'required|string',
            'category' => 'sometimes|string',
            'word' => 'required|string',
            'time_allowed' => 'sometimes|string',
        ]);

        $new= Words::create(
            [
                'judge_id' => $request->judge_id,
                'hint1' => $request->hint1,
                'hint2' => $request->hint2,
                'hint3' => $request->hint3,
                'category' => $request->category,
                'word' => $request->word,
                'time_allowed' => $request->time_allowed,
            ]);
        return $new;
    }
    public function show($id){
        $user = Words::whereJudge_id($id)->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Words::all();
        return $user;
    }
    public function destroy($id){
        $user = Words::where('judge_id', $id)->delete();
        return $user;
    }
}