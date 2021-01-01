<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HabitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Habit::all();
        return response()->json([
            'message' => 'ok',
            'data' => $items
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Habit;
        $item->user_id = $request->user_id;
        $item->habit=$request->habit;
        $item->save();
        return response()->json([
            'message'=>'habit created succesfully',
            'data'=>$item
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function show(Habit $habit)
    {
        $item = Habit::where('id', $habit->id)->first();
        $user_id = $item->user_id;
        $user = DB::table('users')->where('id', (int)$user_id)->first();
        $content = DB::table('contains')->where('habit_id', $habit->id)->get();
        $content_data = array();
        if (empty($content->toArray())) {
            $items = [
                "item" => $item,
                "name" => $user->name,
                "content" => $content_data, 
            ];
            return response()->json($items, 200);
        }else {
        foreach ($content as $value) {
            $content_user = DB::table('users')->where('id', $value->user_id)->first();
            $contents = [
                "content" => $value,
                "content_user" => $content_user,
            ];
            array_push($content_data, $contents);
        }
        
        $items = [
            "item" => $item,
            "name" => $user->name,
            "content" => $content_data,
        ];
        return response()->json($items, 200);
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habit $habit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Habit  $habit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habit $habit)
    {
        $item=Habit::where('id',$habit->id)->delete();
        if($item){
            return response()->json([
                'message'=>'habit deleted successfully'
            ],200);
        }else{
            return response()->json([
                'message'=>'habit not deleted'
            ],404);
        }
    }
}
