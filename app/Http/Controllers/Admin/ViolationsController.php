<?php

namespace App\Http\Controllers\Admin;
use App\Models\Violations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ViolationResource;
use Illuminate\Support\Facades\DB;

class ViolationsController extends Controller
{
    public function getViolationDetails(){
        $res = DB::table('violations')
        ->join('basic_information','basic_information.uid','=','violations.uid')
        ->select('violations.*','basic_information.fname','basic_information.lname',
        'basic_information.avatar')
        ->get();

        if(isset($res)){
            return $res;
        }else{
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }
    }

    public function getViolationDetailsById($uid){
        $res = DB::table('violations')
        ->join('basic_information','basic_information.uid','=','violations.uid')
        ->join('users','users.id','=','basic_information.uid')
        ->select('users.status as userStatus','violations.uid as jid','violations.violation_type','violations.word_id',
        'violations.status')
        ->where('violations.uid',$uid)
        ->get();

        if(isset($res)){
            return $res;
        }else{
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }
    }

    public function getViolationInfo(){
        $res = DB::table('violations')
        ->join('basic_information','basic_information.uid','=','violations.uid')
        ->select('violations.uid as jid','basic_information.fname','basic_information.lname',
        'basic_information.avatar',DB::raw('count(violations.uid) as v_count'))
        ->groupBy('violations.uid','basic_information.fname','basic_information.lname',
        'basic_information.avatar')
         ->get();
        if(isset($res))
        {
            return ViolationResource::collection($res);
        }else{
            return ['success' => false];
        }
    }
    public function getViolationCount($uid){
        $count = Violations::whereUid($uid)->count();
        if(isset($count))
        {
            return $count;
        }
        else
        {
            return ['success' => false];
        }
    }
}
