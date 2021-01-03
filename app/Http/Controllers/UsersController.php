<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function get(Request $request)
    {
        if($request->has('name')){
            $items=DB::table('users')->where('name',$request->name)->get();
            return response()->json([
                'message'=>'user got succesfully',
                'data'=>$items
            ],200);
        }else{
            return response()->json([
                'status'=>'not found'
            ],404);
        }
    }
    public function put(Request $request){
        $param=[
            'name'=>$request->name,
            'email'=>$request->email
        ];
        DB::table('users')->where('email',$request->email)->update($param);
        return response()->json([
            'message'=>'user updated succesfully',
            'data'=>$param
        ],200);
    }
}
