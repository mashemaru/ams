<?php

namespace App\Http\Controllers;

use App\Task;
use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Task $task)
    {
        auth()->user()->load('teams','teams.users','teams.head','team_head','team_head.users');
        if(auth()->user()->teams->isEmpty())
            $users = auth()->user()->team_head->first()->users;
        elseif(auth()->user()->team_head->isEmpty())
            $users = auth()->user()->teams->first()->users->push(auth()->user()->teams->first()->head);

        return view('task.index', ['tasks' => $task->paginate(15), 'users' => $users]);
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
        $validate = Validator::make($request->all(), [
            'task_name'     => 'required|max:255',
            'assign_to'     => 'required',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }
    
        foreach($request->assign_to as $assign) {
            Task::create([
                'task_name'  => $request->task_name,
                'assigner'   => auth()->user()->id,
                'asigned_to' => $assign,
                'due_date'   => $request->due_date,
                'remarks'    => $request->remarks,
            ]);
        }

        return back()->withToastSuccess(__('Task successfully created.'));
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
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back()->withToastSuccess(__('Task successfully deleted.'));
    }

    public function taskInProgress(Task $task)
    {
        $task->update([
            'status' => 'in-progress'
        ]);
        Notification::create([
            'user_id' => auth()->user()->id,
            'text'    => 'started the task <strong>' . $task->task_name . '</strong>',
        ]);
        return back()->withToastSuccess(__('Action completed successfully.'));
    }

    public function taskComplete(Task $task)
    {
        $task->update([
            'status' => 'complete'
        ]);
        Notification::create([
            'user_id' => auth()->user()->id,
            'text'    => 'completed the task <strong>' . $task->task_name . '</strong>',
        ]);
        return back()->withToastSuccess(__('Action completed successfully.'));
    }
}
