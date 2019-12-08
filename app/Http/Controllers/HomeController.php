<?php

namespace App\Http\Controllers;

use App\Task;

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
        return view('dashboard');
    }

    public function activities()
    {
        $events = Task::select('task_name','due_date')->where('asigned_to', auth()->user()->id)->get();

        if(auth()->user()->hasRole('super-admin'))
            $events = Task::select('task_name','due_date')->get();

        return view('activities.index', compact('events'));
    }
}
