<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContestantAttempts;


class ContestantAttemptController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'uid' => 'required|string',
            'word_id' => 'required|string',
            'time_taken' => 'sometimes|string',
            'score' => 'required|string',
            'hint1_status' => 'sometimes|string',
            'hint2_status' => 'sometimes|string',
            'hint3_status' => 'sometimes|string',
        ]);

        $new= ContestantAttempts::create(
            [
                'uid' => $request->uid,
                'word_id' => $request->word_id,
                'time_taken' => $request->time_taken,
                'score' => $request->score,
                'hint1_status' => $request->hint1_status,
                'hint2_status' => $request->hint2_status,
                'hint3_status' => $request->hint3_status,
            ]);
        return $new;
    }
    public function show($id){
        $user = ContestantAttempts::whereUid($id)->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = ContestantAttempts::all();
        return $user;
    }
    public function destroy($id){
        $user = ContestantAttempts::where('uid', $id)->delete();
        return $user;
    }
}
