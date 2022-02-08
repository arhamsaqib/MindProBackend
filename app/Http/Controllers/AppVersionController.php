<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppVersion;

class AppVersionController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'version' => 'required|string',
            'force' => 'required|string',
        ]);
        $new= AppVersion::create(
            [
            'version' => $request->version,
            'force' => $request->force,
        ]);
        return $new;
    }
    public function show($id){
        $user = AppVersion::all();
        return $user;
    }
    public function index(){
        $user = AppVersion::latest()->first();
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
