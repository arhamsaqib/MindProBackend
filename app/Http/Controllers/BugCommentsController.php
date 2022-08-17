<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BugComments;

class BugCommentsController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'bugId' => 'required',
            'userId' => 'sometimes',
            'comment' => 'required',
        ]);
        $collection = collect($data)->filter()->all();
        $new = BugComments::create($collection);
        return $new;
    }
    public function update($commentId,Request $request){
        $data = $request->validate([
            'comment' => 'sometimes',
        ]);
 
        $booking = BugComments::where(['id'=>$commentId])->first();
         
        $collection = collect($data)->filter()->all();
 
         $new = $booking->update($collection);
         return $new;
      
     }
    public function show($id){
        $user = BugComments::where(['bugId'=>$id])->latest()->get();
        return $user;
    }
    public function index(){
        $user = BugComments::latest()->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Comment history not found.'
        ], 404);
    }
    public function destroy($id){
        $user = BugComments::where(['id'=>$id])->delete();
        return $user;
    }
}
