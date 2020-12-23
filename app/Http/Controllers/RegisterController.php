<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    public function post(Request $request)
    {
        $hashed_password=Hash::make($request->password);
        $now=Carbon::now();

        $param=
        [
            "name" =>$request->name,
            "email" =>$request->email,
            "password" =>$hashed_password,
            "created_at" =>$now,
            "updater_at" =>$now,
        ];
        // データベースに挿入して、帰ってくるレスポンスに対して、jsonコレクションで、jsonに変える。そのときにメッセージとデータと、ステータスコードを入れれる。
        DB::table('users')->insert($param);
        return response()->json([
            'message'=>'user created successfully',
            'data'=>$param
        ],200);


    }
}
