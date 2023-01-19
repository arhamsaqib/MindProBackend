<?php

namespace App\Http\Controllers\Admin;
use App\Models\ReportBugs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class FeedbackController extends Controller
{
    public function fetchUserFeedback($uid){
        $res = ReportBugs::whereUid($uid)->get();
        if(isset($res))
        {
            return $res;
        }
        else{
            return response()->json([
                'message' => 'Record not found.'
            ], 404);
        }
    }
}