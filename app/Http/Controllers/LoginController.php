<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    
    public function post(Request $request){
   
        $items=DB::table('users')->where('name',$request->name)->first();
        if(Hash::check($request->password, $items->password))
     {
        return response()->json(['auth'=>true],200
         );
    } else{
        return response()->json([
            'auth'=>false
        ],200);
    }
}
}