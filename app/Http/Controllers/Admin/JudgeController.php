<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Judges;
use App\Http\Controllers\Controller;
use App\Models\ReportBugs;
use App\Http\Resources\AdminJudgeResource;

class JudgeController extends Controller
{
    public function index(){
       
        $judges = DB::table('judges')
        ->join('users', 'users.id', '=', 'judges.uid')
        ->join('basic_information', 'basic_information.id', '=', 'judges.uid')
        ->select('users.username' , 'users.email', 'users.status' , 'users.created_at' , 'basic_information.fname',
                    'basic_information.lname','basic_information.avatar','basic_information.country',
                    'basic_information.city', 'judges.id as judgeId', 'users.id as userId','users.created_at')->get();
        $data = [];
        foreach ($judges as $j) {
            $id = $j->userId;
            $bugs = ReportBugs::whereUid($id)->get();
            $array    = collect($j);
            $array['feedback'] = $bugs;
            $data[] = $array;
        }
        return AdminJudgeResource::collection($judges);
    }
}
