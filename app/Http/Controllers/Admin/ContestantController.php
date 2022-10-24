<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Contestants;
use App\Http\Controllers\Controller;
use App\Models\ReportBugs;
use App\Http\Resources\AdminContestantResource;

class ContestantController extends Controller
{
    public function index(){
       
        $contestants = DB::table('contestants')
        ->join('users', 'users.id', '=', 'contestants.uid')
        ->join('basic_information', 'basic_information.id', '=', 'contestants.uid')
        ->select('users.username' , 'users.email', 'users.status' , 'users.created_at' , 'basic_information.fname',
                    'basic_information.lname','basic_information.avatar','basic_information.country',
                    'basic_information.city', 'contestants.id as contestantId', 'users.id as userId','users.created_at')->get();
        return AdminContestantResource::collection($contestants);
    }
}
