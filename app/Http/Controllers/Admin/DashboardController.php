<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Judges;
use App\Models\Contestants;
use App\Http\Controllers\Controller;
use App\Models\ReportBugs;

class DashboardController extends Controller
{
    public function index(){
       
        $judges = Judges::count();
        $cont = Contestants::count();
        return [
            "totalJudges" => $judges,
            "totalContestants" => $cont
        ];
    }
}
