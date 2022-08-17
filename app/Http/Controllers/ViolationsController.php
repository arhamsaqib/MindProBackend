<?php

namespace App\Http\Controllers;
use App\Models\Violations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViolationsController extends Controller
{
    public function getViolationDetails(){
        $res = DB::table('Violations')
        ->join('Basic_Information','Basic_Information.uid','=','Violations.uid')
        ->select('Violations.*','Basic_Information.fname','Basic_Information.lname',
        'Basic_Information.avatar')
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
        $res = DB::table('Violations')
        ->join('Basic_Information','Basic_Information.uid','=','Violations.uid')
        ->select('Violations.uid','Basic_Information.fname','Basic_Information.lname',
        'Basic_Information.avatar',DB::raw('count(Violations.uid) as v_count'))
        ->groupBy('Violations.uid','Basic_Information.fname','Basic_Information.lname',
        'Basic_Information.avatar')
         ->get();
        if(isset($res))
        {
            return $res;
        }else{
            return 'Error';
        }
    }
}
