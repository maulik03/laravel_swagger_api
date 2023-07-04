<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Exception;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todo_list = TodoList::all();
        
        return response()->json($todo_list);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $todo = new TodoList;
            $todo->name = $request->name;
            $todo->description = $request->description;
            $todo->is_priority = $request->is_priority;
            $todo->save();

            return response()->json([
                "message"=>"Todo task added."
            ], 201);
        } catch (Exception $e) {
            return response().json([
                "message"=>$e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, TodoList $todoList)
    {
        $id = $request->id;
        $todo = $todoList::find($id);
        if (!empty($todo)) {
            return response()->json($todo);
        } else {
            return response()->json([
                "message"=>"Todo task not found"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoList $todoList)
    {
        $id = $request->id;
        if ($todoList::where('id', $id)->exists()) {
            $todo = $todoList::find($id);
            $todo->name = is_null($request->name) ? $todo->name : $request->name;
            $todo->description = is_null($request->description) ? $todo->description : $request->description;
            $todo->is_priority = is_null($request->is_priority) ? $todo->is_priority : $request->is_priority;
            $todo->is_done = is_null($request->is_done) ? $todo->is_done : $request->is_done;
            $todo->user_id = is_null($request->user_id) ? $todo->user_id : $request->user_id;
            
            $todo->save();
            return response()->json([
                "message"=>"Todo task updated."
            ], 200);
        } else {
            return response()->json([
                "message"=>"Todo task not found."
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, TodoList $todoList)
    {
        try {
            $id = $request->id;
            if ($todoList::where('id', $id)->exists()) {
                $todo = $todoList::find($id);
                $todo->delete();
    
                return response()->json([
                    "message"=>"Todo task deleted."
                ], 202);
            } else {
                return response()->json([
                    "message"=>"Todo task not found."
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                "message"=>$e->getMessage()
            ], 500);
        }
    }
}
