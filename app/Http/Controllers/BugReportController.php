<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReportBugs;

class BugReportController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'description' => 'required|string',
            'uid' => 'required|string',
        ]);
        $new= ReportBugs::create(
            [
            'description' => $request->description,
            'uid' => $request->uid,
            'status' => 'active',
        ]);
        return $new;
    }
    public function update($bugId,Request $request){
        $data = $request->validate([
            'status' => 'sometimes',
        ]);
 
        $booking = ReportBugs::where(['id'=>$bugId])->first();
         
        $collection = collect($data)->filter()->all();
 
         $new = $booking->update($collection);
         return $new;
      
     }
    public function show($id){
        $user = ReportBugs::whereid($id)->get();
        return $user;
    }
    public function index(){
        $user = ReportBugs::latest()->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Version history not found.'
        ], 404);
    }
    public function destroy($id){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 403);
    }
}
