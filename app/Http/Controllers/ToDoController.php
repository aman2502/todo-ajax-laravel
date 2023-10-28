<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Request $request){
        if($request->show == 'allTask'){
            $todos = Todo::all();
            return response()->json(['todo'=> $todos]);
        }
        else{
            $todos = Todo::all();
            return view('index',['todos'=>$todos]);
        }
        
    }
    public function add(Request $request){
        if($request->ajax()){
            $task = Todo::all();
            // dd($task);
            if(count($task) > 0){
                $isStringInArray = collect($task)->pluck('title')->contains($request->title);
                if($isStringInArray){
                    return response()->json(['error'=>'Title Already Taken']);
                }
                else{
                        $todo = new Todo;
                        $todo->title = $request->title;
                        $todo->save();
                        $last_todo = Todo::where('id',$todo->id)->get();
                        return view('data',['todos'=>$last_todo]);
                }
            }
            else{
                dd('pppp');
                $todo = new Todo;
                $todo->title = $request->title;
                $todo->save();
                $last_todo = Todo::where('id',$todo->id)->get();
                return view('data',['todos'=>$last_todo]);
            }
            
            
        }
    }
    public function update(Request $request, $id){
        if($request->ajax()){
            $todo = Todo::find($id);
            $todo->title = $request->title;
            $todo->save();
            return "OK";
        }
    }
    public function delete(Request $request,$id){
        if($request->ajax()){
            $todo = Todo::find($id);
            $todo->delete();
            return "OK";
        }
    }
    public function done(Request $request,$id){
        if($request->ajax()){
            $todo = Todo::find($id);
            $todo->status = 2;
            $todo->save();
            return "OK";
        }
    }

    public function changeStatus(Request $request)
    {
        $todo= Todo::find((int)($request->task_id));


        if($todo->status == 1)
        {
            $status='0';
        }
        else
        {
            $status='1';
        }

        $todo->status = $status;
        $todo->update();
        return response()->json([
            'message'=> 'Status Updated Successfully.'
        ]);
    }


}
