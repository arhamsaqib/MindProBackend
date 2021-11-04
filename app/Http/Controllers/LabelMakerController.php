<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabelMakerController extends Controller
{
    public function store(Request $request){

        $hint1 = $request->hint1_status;
        $hint2 = $request->hint2_status;
        $hint3 = $request->hint3_status;

        //Converting request from string to number
        $allowed = (int)$request->time_allowed;
        $taken = (int)$request->time_taken;

        //Allowed time divided into 2 parts
        $q1 = $allowed / 3;
        $q2 = $q1 * 2;

        //All Labels
        $accurate = false;
        $fast = false;
        $rising = false;
        $efficient = false;

        if($hint1 == "true" && $hint2 == "true" && $hint3 == "true" ){
            
            $accurate = true;
            if($taken <= $q1){
               
                $fast=true;
            
            }
            if($taken > $q1 && $taken <= $q2){
               
                $efficient=true;
            
            }
        
        }
        if($hint1 == "false" && $hint2 == "true" && $hint3 == "true" ){
            
            $rising = true;
        
        }
        if($hint1 == "true" && $hint2 == "false" && $hint3 == "true" ){
            
            $rising = true;
        
        }
        if($hint1 == "true" && $hint2 == "true" && $hint3 == "false" ){
            
            $rising = true;
        
        }

        $ret = [
            "rising" => $rising,
            "efficient" => $efficient,
            "fast" => $fast,
            "accurate" => $accurate,
        ];

        return response()->json($ret,200);

    }
    public function show($label){
        $all = array(
            "rising",
            "efficient",
            "fast",
            "accurate",
        );

        if(in_array($label, $all))
        {
            return response()->json([
                'message' => 'Label found.'
            ], 200);

        }
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $all = array(
            "rising",
            "efficient",
            "fast",
            "accurate",
        );
        return response()->json($all);
    }
    public function destroy($id){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 405);
    }
}
