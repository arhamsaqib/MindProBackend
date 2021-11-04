<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Labels;


class LabelsController extends Controller
{
    public function store(Request $request){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 405);
    }
    public function show($id){
        $user = Labels::whereId($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Labels::all();
        return $user;
    }
    public function destroy($id){
        $user = Labels::where('id', $id)->delete();
        return $user;
    }
}
