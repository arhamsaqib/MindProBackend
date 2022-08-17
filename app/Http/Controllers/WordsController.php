<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Words;
use App\Models\ContestantAttempts;


class WordsController extends Controller
{
    public function store(Request $request){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 405);
    }
    public function show($id){
        $user = Words::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Words::whereStatus('active')->latest()->get();
        return $user;
    }
    public function destroy($id){
        $user = Words::where('id', $id)->delete();
        return $user;
    }
    public function getWordsWithFilter(Request $request){

        $data = $request->validate([
            'time_allowed' => 'sometimes',
            'category' => 'sometimes',
        ]);
        $cid = $request->cid;
        $collection = collect($data)->filter();
        $collection->put('status' , 'active');


        $all = Words::where($collection->all())->get();

        if(isset($cid)){
            $arr = [];
            foreach ($all as $w) {
                $wid = $w['id'];
                $x =  ContestantAttempts::where([
                    'word_id' => $wid,
                    'cid' => $cid
                ])->first();
                if(!isset($x)){
                    $arr[] = $w;
                }
            }
            return $arr;
        }

        return $all;
        // $time = $request->time_allowed;
        // $category = $request->category;
       
        // if(isset($time) && !isset($category)){
        //     $timefiltered = Words::where(['time_allowed'=> $time,'status'=>'active'])->get();
        //     return $timefiltered;
        // }
        // if(!isset($time) && isset($category)){
        //     $categoryFiltered = Words::where(['category'=> $category,'status'=>'active'])->get();
        //     return $categoryFiltered;
        // }
        // if(isset($time) && isset($category)){
        //     $allfiltered = Words::where(['category' => $category,'time_allowed' => $time,'status'=>'active'])->get();
        //     return $allfiltered;
        // }
        // if(!isset($time) && !isset($category)){
        //     $all = Words::whereStatus('active')->latest()->get();
        //     return $all;
        // }
    }
}
