<?php

namespace App\Http\Controllers;

use App\Timeline;
use App\Accreditation;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Accreditation $accreditation)
    {
        $task = array();
        foreach ($request->task as $key => $t) {
            $t['is_complete'] = 0;
            $task[] = $t;
        }

        Timeline::updateOrCreate(
            ['accreditation_id' => $accreditation->id],
            ['task' => $task]
        );
        
        return redirect()->route('task.index')->withToastSuccess(__('Timeline successfully created.'));
        // return redirect()->route('team.create')->withToastSuccess(__('Timeline successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function show(Timeline $timeline, Accreditation $accreditation)
    {
        return view('timeline.create',compact('accreditation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function edit(Timeline $timeline)
    {
        return view('timeline.edit',compact('timeline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timeline $timeline)
    {
        $timelineTask = array();
        $status = 0;
        if($request->task) {
            foreach ($request->task as $k => $task) {
                $timelineTask[$k] = $task;
                if (isset($task['is_complete'])) {
                    $timelineTask[$k]['is_complete'] = 1;
                    $status++;
                } else {
                    $timelineTask[$k]['is_complete'] = 0;
                }
            }
        }

        $status = ($request->task) ? ($status * 100) / count($request->task) : 0;
        $timeline->update([
            'task'      => $timelineTask,
            'status'    => $status,
        ]);
        $timeline->accreditation()->update([
            'status'    => $status,
        ]);

        return redirect()->route('accreditation.index')->withToastSuccess(__('Timeline successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timeline  $timeline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Timeline $timeline)
    {
        //
    }

    public function is_complete_update(Request $request, Timeline $timeline)
    {
        $timelineTask = array();
        foreach ($timeline->task as $key => $t) {
            $t['is_complete'] = 0;
            $timelineTask[] = $t;
            if($request->task) {
                foreach ($request->task as $k => $task) {
                    if ($key == $k) {
                        $timelineTask[$key]['is_complete'] = 1;
                    }
                }
            }
        }

        $status = ($request->task) ? (count($request->task) * 100) / count($timeline->task) : 0;
        $timeline->update([
            'task'      => $timelineTask,
            'status'    => $status,
        ]);
        $timeline->accreditation()->update([
            'status'    => $status,
        ]);
        return back()->withToastSuccess(__('Timeline successfully updated.'));
    }
}
