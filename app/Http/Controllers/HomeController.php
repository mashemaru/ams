<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use App\Notification;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        /*
        auth()->user()->load('teams.users','teams.head','team_head.users');
        $users = collect();
        auth()->user()->teams->each(function($q) use(&$users) {
            $users->push($q->head);
            $users = $users->concat($q->users);
        });

        // if(!auth()->user()->hasRole('super-admin')) {
        //     $notification = Notification::with('user')->where('user_id',auth()->user()->id)->latest()->get();
        // }
        if(auth()->user()->hasRole('super-admin')) {
            $users = User::all();
        }
        
        $assigned = $users->pluck('id');
        $assigned->push(auth()->user()->id);
        */
        $notification = Notification::with('user')->where('user_id', auth()->user()->id)->latest()->get()->unique('text');
        $tasks = Task::where('asigned_to', auth()->user()->id)->latest()->get();
    
        return view('dashboard', ['tasks' => $tasks, 'notifications' => $notification]);
    }

    public function activities()
    {
        $events = Task::select('task_name','due_date')->where('asigned_to', auth()->user()->id)->get();

        // if(auth()->user()->hasRole('super-admin'))
        //     $events = Task::select('task_name','due_date')->get();

        return view('activities.index', compact('events'));
    }
}
