<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Words;
use App\Models\Violations;


class JudgeWordsController extends Controller
{
    public function hasViolations($scanWord){
        $blacklist_words = ['bullshit','heck','ass','balls','fuck','dick','asshole','motherfucker',
    'cunt'];
        //Checking Word
        $check = in_array($scanWord->word,$blacklist_words,true);
        if($check)
        {
            Violations::create([
                'uid'=>$scanWord->judge_id,
                'word_id'=>$scanWord->id,
                'violation_type'=>'Abusive Word',
                'status'=>'banned',
            ]);
            return true;
        }
        // Checking Hint 1
        else{
            $check = in_array($scanWord->hint1,$blacklist_words,true);
            if($check)
            {
                Violations::create([
                    'uid'=>$scanWord->judge_id,
                    'word_id'=>$scanWord->id,
                    'violation_type'=>'Abusive hint 1',
                    'status'=>'banned',
                ]);
                return true;
            }
            // Checking Hint 2
            else{
                $check = in_array($scanWord->hint2,$blacklist_words,true);
                if($check)
                {
                    Violations::create([
                        'uid'=>$scanWord->judge_id,
                        'word_id'=>$scanWord->id,
                        'violation_type'=>'Abusive hint 2',
                        'status'=>'banned',
                    ]);
                    return true;
                }
                //Checking Hint 3
                else{
                    $check = in_array($scanWord->hint3,$blacklist_words,true);
                    if($check)
                    {
                        Violations::create([
                            'uid'=>$scanWord->judge_id,
                            'word_id'=>$scanWord->id,
                            'violation_type'=>'Abusive hint 3',
                            'status'=>'banned',
                        ]);
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
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
                'status' => 'active',
            ]);

        $foundViolation = $this->hasViolations($new);
        return $new;
    }
    public function update($id,Request $request){
        $data = $request->validate([
            'hint1' => 'sometimes',
            'hint2' => 'sometimes',
            'hint3' => 'sometimes',
            'category' => 'sometimes',
            'word' => 'sometimes',
            'time_allowed' => 'sometimes',
            'status' => 'sometimes',
        ]);
        $provider = Words::whereId($id)->first();
        $collection = collect($data)->filter()->all();
        $new = $provider->update($collection);
        return $new;
    }
    public function show($id){
        $user = Words::whereJudge_id($id)->latest()->get();
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
