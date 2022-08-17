<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChangeLogs;

class ChangelogController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'version' => 'required|string',
            'description' => 'required|string',
        ]);
        $new= ChangeLogs::create(
            [
            'description' => $request->description,
            'version' => $request->version,
        ]);
        return $new;
    }
    public function show($id){
        $user = ChangeLogs::whereid($id)->get();
        return $user;
    }
    public function index(){
        $user = ChangeLogs::latest()->get();
        if(isset($user)){
            return $user;
        }
    
        return response()->json([
            'message' => 'Changelog history not found.'
        ], 404);
    }
    public function destroy($id){
        return response()->json([
            'message' => 'Method not allowed.'
        ], 403);
    }
}
