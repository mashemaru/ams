<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Team;
use App\Notification;
use Carbon\Carbon;
use App\Events\LiveNotification;
use Spatie\Permission\Models\Role;
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
        auth()->user()->load('teams.users','teams.head','team_head.users');
        $users = collect();
        auth()->user()->teams->each(function($q) use(&$users) {
            $users->push($q->head);
            $users = $users->concat($q->users);
        });

        if(auth()->user()->hasRole('super-admin'))
            $users = User::all();

        $roles = Role::all();
        // $teams = Team::whereHas('accreditations')->get();
        $teams = Team::all();
        $assigned = $users->pluck('id');
        $assigned->push(auth()->user()->id);

        if(auth()->user()->hasRole('super-admin')) {
            $query = $task->whereIn('asigned_to', $assigned)->latest()->paginate(15);
        } else {
            $query = $task->where('asigned_to', auth()->user()->id)->latest()->paginate(15);
        }

        // if(auth()->user()->teams->isEmpty() && auth()->user()->team_head->isEmpty())
        //     $users = User::all();
        // elseif(auth()->user()->teams->isEmpty())
        //     $users = auth()->user()->team_head->first()->users;
        // elseif(auth()->user()->team_head->isEmpty())
        //     $users = auth()->user()->teams->first()->users->push(auth()->user()->teams->first()->head);
            
    
        return view('task.index', ['tasks' => $query, 'users' => $users, 'roles' => $roles, 'teams' => $teams]);
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
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }
    
        if($request->assign_to) {
            foreach($request->assign_to as $assign) {
                Task::create([
                    'task_name'  => $request->task_name,
                    'assigner'   => auth()->user()->id,
                    'asigned_to' => $assign,
                    'due_date'   => $request->due_date,
                    'remarks'    => $request->remarks,
                    'priority'   => $request->priority,
                    'recurring'  => isset($request->recurring) ? true : false,
                    'recurring_freq'  => isset($request->recurring) ? $request->recurring_freq : null,
                    'recurring_date'  => isset($request->recurring) ? Carbon::now()->addDays($request->recurring_freq) : null,
                ]);
                event(new LiveNotification('Task ('.$request->task_name.') assigned.',$assign));
            }
        }

        if($request->assign_to_roles) {
            foreach($request->assign_to_roles as $assign) {
                $users = User::whereHas("roles", function($q) use(&$request){ $q->whereIn('id', $request->assign_to_roles); })->get();
                foreach($users as $user) {
                    Task::create([
                        'task_name'  => $request->task_name,
                        'assigner'   => auth()->user()->id,
                        'asigned_to' => $user->id,
                        'due_date'   => $request->due_date,
                        'remarks'    => $request->remarks,
                        'priority'   => $request->priority,
                        'recurring'  => isset($request->recurring) ? true : false,
                        'recurring_freq'  => isset($request->recurring) ? $request->recurring_freq : null,
                        'recurring_date'  => isset($request->recurring) ? Carbon::now()->addDays($request->recurring_freq) : null,
                    ]);
                    event(new LiveNotification('Task ('.$request->task_name.') assigned.',$user->id));
                }
            }
        }

        if($request->assign_to_team) {
            foreach($request->assign_to_team as $team) {
                $users = User::whereHas('teams', function($q) use(&$request){ $q->whereIn('id', $request->assign_to_team); })->get();
                $team = Team::with('head')->whereIn('id', $request->assign_to_team)->get();
                foreach($team as $t) {
                    $users->push($t->head);
                }
                if($users) {
                    foreach($users as $user) {
                        Task::create([
                            'task_name'  => $request->task_name,
                            'assigner'   => auth()->user()->id,
                            'asigned_to' => $user->id,
                            'due_date'   => $request->due_date,
                            'remarks'    => $request->remarks,
                            'priority'   => $request->priority,
                            'recurring'  => isset($request->recurring) ? true : false,
                            'recurring_freq'  => isset($request->recurring) ? $request->recurring_freq : null,
                            'recurring_date'  => isset($request->recurring) ? Carbon::now()->addDays($request->recurring_freq) : null,
                        ]);
                        event(new LiveNotification('Task ('.$request->task_name.') assigned.',$user->id));
                    }
                }
            }
        }

        return back()->withToastSuccess(__('Task successfully created.'));
    }

    public function storeAppendixTask(Request $request, $document_outline)
    {
        $validate = Validator::make($request->all(), [
            'task_name'     => 'required|max:255',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }
    
        $url = url("/document-outline/{$document_outline}/edit?appendix={$request->appendix_id}");

        if($request->assign_to) {
            foreach($request->assign_to as $assign) {
                Task::create([
                    'task_name'  => $request->task_name,
                    'assigner'   => auth()->user()->id,
                    'asigned_to' => $assign,
                    'due_date'   => $request->due_date,
                    'remarks'    => 'Upload evidence in Appendix/Exhibit (' . $request->appendix_name . ') click <a href="' . $url . '">here</a>',
                    'priority'   => $request->priority,
                    'recurring'  => isset($request->recurring) ? true : false,
                    'recurring_freq'  => isset($request->recurring) ? $request->recurring_freq : null,
                    'recurring_date'  => isset($request->recurring) ? Carbon::now()->addDays($request->recurring_freq) : null,
                ]);
                event(new LiveNotification('Task ('.$request->task_name.') assigned.',$assign));
            }
        }

        if($request->assign_to_team) {
            foreach($request->assign_to_team as $team) {
                $users = User::whereHas('teams', function($q) use(&$request){ $q->whereIn('id', $request->assign_to_team); })->get();
                $team = Team::with('head')->whereIn('id', $request->assign_to_team)->get();
                foreach($team as $t) {
                    $users->push($t->head);
                }
                if($users) {
                    foreach($users as $user) {
                        Task::create([
                            'task_name'  => $request->task_name,
                            'assigner'   => auth()->user()->id,
                            'asigned_to' => $user->id,
                            'due_date'   => $request->due_date,
                            'remarks'    => 'Upload evidence in Appendix/Exhibit (' . $request->appendix_name . ') click <a href="' . $url . '">here</a>',
                            'priority'   => $request->priority,
                            'recurring'  => isset($request->recurring) ? true : false,
                            'recurring_freq'  => isset($request->recurring) ? $request->recurring_freq : null,
                            'recurring_date'  => isset($request->recurring) ? Carbon::now()->addDays($request->recurring_freq) : null,
                        ]);
                        event(new LiveNotification('Task ('.$request->task_name.') assigned.',$user->id));
                    }
                }
            }
        }

        return back()->withToastSuccess(__('Task successfully created.'));
    }

    public function storeAccreditationRecommendations(Request $request, $accreditation)
    {
        $validate = Validator::make($request->all(), [
            'task_name'     => 'required|max:255',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }
    
        $url = url("/accreditation/{$accreditation}");

        if($request->assign_to) {
            foreach($request->assign_to as $assign) {
                Task::create([
                    'task_name'  => $request->task_name,
                    'assigner'   => auth()->user()->id,
                    'asigned_to' => $assign,
                    'due_date'   => $request->due_date,
                    'remarks'    => 'Answer recommendations for Task ('.$request->task_name.'). click <a href="' . $url . '">here</a>',
                    'priority'   => $request->priority,
                    'recurring'  => isset($request->recurring) ? true : false,
                    'recurring_freq'  => isset($request->recurring) ? $request->recurring_freq : null,
                    'recurring_date'  => isset($request->recurring) ? Carbon::now()->addDays($request->recurring_freq) : null,
                ]);
                event(new LiveNotification('Task ('.$request->task_name.') assigned.',$assign));
            }
        }

        if($request->assign_to_team) {
            foreach($request->assign_to_team as $team) {
                $users = User::whereHas('teams', function($q) use(&$request){ $q->whereIn('id', $request->assign_to_team); })->get();
                $team = Team::with('head')->whereIn('id', $request->assign_to_team)->get();
                foreach($team as $t) {
                    $users->push($t->head);
                }
                if($users) {
                    foreach($users as $user) {
                        Task::create([
                            'task_name'  => $request->task_name,
                            'assigner'   => auth()->user()->id,
                            'asigned_to' => $user->id,
                            'due_date'   => $request->due_date,
                            'remarks'    => 'Answer recommendations for Task ('.$request->task_name.'). click <a href="' . $url . '">here</a>',
                            'priority'   => $request->priority,
                            'recurring'  => isset($request->recurring) ? true : false,
                            'recurring_freq'  => isset($request->recurring) ? $request->recurring_freq : null,
                            'recurring_date'  => isset($request->recurring) ? Carbon::now()->addDays($request->recurring_freq) : null,
                        ]);
                        event(new LiveNotification('Task ('.$request->task_name.') assigned.',$user->id));
                    }
                }
            }
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
