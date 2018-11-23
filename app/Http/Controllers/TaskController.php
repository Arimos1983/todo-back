<?php

namespace App\Http\Controllers;
use App\Task;
use App\User;
use Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        return Task::where('user_id', $id)->get();
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Task::taskValidationRules($request);

        Task::create([
            'title' => request('title'),
            'description' => request('description'),
            'priority' => request('priority'),
            'user_id' => auth()->user()->id
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Task::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        Task::taskValidationRules($request);

        $task = Task::findOrFail($id);
        if($task->user_id === auth()->user()->id){
        $task->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $task = Task::findOrFail($id);
        if($task->user_id === auth()->user()->id){
           return Task::destroy($id);
        }
        else
        { 
            return "You are not authorized to delete this task";
        }
        
    }
}
