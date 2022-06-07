<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labels;
use Illuminate\Support\Facades\DB;


class ContestantLabels extends Controller
{
    public function store(Request $request){
        $request->validate([
            'uid' => 'required|string',
            'attempt_id' => 'required|string',
            'label' => 'required|string',
        ]);

        $new= Labels::create(
            [
                'uid' => $request->uid,
                'attempt_id' => $request->attempt_id,
                'label' => $request->label,
            ]);
        return $new;
    }
    public function show($id){
       $user = Labels::whereUid($id)->distinct('label')->get()->unique('label');
        //$user = Labels::select('id','uid','label','attempt_id')->unique('label')->whereUid($id)->get();
        //$user = Labels::whereUid($id)->select('label')->distinct()->get();
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
        $user = Labels::where('uid', $id)->delete();
        return $user;
    }
}
