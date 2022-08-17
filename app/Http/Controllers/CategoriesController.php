<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{ 
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'status' => 'sometimes',
            'addedBy' => 'sometimes',
        ]);

        $provider = Categories::whereName($request->name)->first();
        if(isset($provider)){
            return response()->json([
                'message' => 'Category already exists.'
            ],401);
        }

        $collection = collect($data)->filter()->all();
        $new = Categories::create($collection);
        return $new;
    }
    public function update($id,Request $request){
        $data = $request->validate([
            'status' => 'required',
        ]);
        $provider = Categories::whereName($id)->first();
        $collection = collect($data)->filter()->all();
        $new = $provider->update($collection);
        return $new;
    }
    public function show($id){

        //$user = User::find($id);
        $user = Categories::whereName($id)->first();
        if(isset($user)){
            return $user;
        }

        return response()->json([
            'message' => 'Record not found.'
        ], 404);
    }
    public function index(){
        $user = Categories::whereStatus('active')->get();
        return $user;
    }
    public function destroy($id){
        $user = Categories::where('id', $id)->delete();
        return $user;
    }
}
