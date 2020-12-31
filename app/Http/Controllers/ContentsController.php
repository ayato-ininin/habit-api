<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContentsController extends Controller
{
public function post(Request $request){
    $now=Carbon::now();
    $param=[
        "habit_id"=>$request->habit_id,
        "user_id"=>$request->user_id,
        "contain"=>$request->contain,
        "point"=>$request->point,
        "created_at"=>$now,
        "updated_at"=>$now
    ];
    DB::table('contents')->insert($param);
    return response()->json([
        'message'=>'contents created suceessfully',
        'data'=>$param
    ],200);
}
}
