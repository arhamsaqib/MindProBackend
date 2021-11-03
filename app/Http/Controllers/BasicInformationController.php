<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasicInformation;


class BasicInformationController extends Controller
{
    
    public function store(Request $request){
        $request->validate([
            'uid' => 'required|string',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'avatar' => 'sometimes|string',
        ]);

        $new= BasicInformation::updateOrCreate(
            [
                'uid' => $request->uid,
            ],
            [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'city' => $request->city,
            'country' => $request->country,
            'avatar' => $request->avatar,
        ]);
        return $new;
    }
    public function show($id){
        $user = BasicInformation::whereUid($id)->first();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = basicInformation::all();
        return $user;
    }
    public function destroy($id){
        $user = BasicInformation::where('uid', $id)->delete();
        return $user;
    }
}
