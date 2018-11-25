<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::orderBy('id', 'desc')->paginate(5);
        return view('tasks.index', ['storedTasks' => $task]);
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
        $this->validate($request, [
          'newTaskName' => 'required|min:5|max:255',
        ]);
        $task = new Task;
        $task->name = request('newTaskName');
        $task->save();
        Session::flash('success', 'New Task Added Successfully');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', ['TaskUnderEdit'=> $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'updatedTask' => 'required|min:5|max:255',
      ]);
        $task = Task::find($id);
        $task->name = request('updatedTask');
        $task->save();
        Session::flash('success', 'Task #'. $id .' Updated Successfully');
        return redirect('task');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $task = Task::find($id);
      $task->delete();
      Session::flash('success', 'Task #'.$id.'Deleted Successfully');
      return back();

    }
}
