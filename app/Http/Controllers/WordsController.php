<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Words;


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
        $time = $request->time_allowed;
        $category = $request->category;
       
        if(isset($time) && !isset($category)){
            $timefiltered = Words::where(['time_allowed'=> $time,'status'=>'active'])->get();
            return $timefiltered;
        }
        if(!isset($time) && isset($category)){
            $categoryFiltered = Words::where(['category'=> $category,'status'=>'active'])->get();
            return $categoryFiltered;
        }
        if(isset($time) && isset($category)){
            $allfiltered = Words::where(['category' => $category,'time_allowed' => $time,'status'=>'active'])->get();
            return $allfiltered;
        }
        if(!isset($time) && !isset($category)){
            $all = Words::whereStatus('active')->latest()->get();
            return $all;
        }
    }
}
