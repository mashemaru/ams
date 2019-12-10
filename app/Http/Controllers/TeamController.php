<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use App\Accreditation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Team $team)
    {
        $team->with('users');
        return view('team.index', ['teams' => $team->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::select('id','firstname','mi','surname')->role('member')->get();

        return view('team.create',compact('users'));
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
            'team_name'     => 'required|min:4',
            'team_head'     => 'required',
            'team_members'  => 'required',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }

        foreach($request->team_members as $members) {
            if($members == $request->team_head)
                return back()->with('error', 'User cannot be both Team Head and Member')->withInput();
        }

        $team = Team::create([
            'team_name' => $request->team_name,
            'team_head' => $request->team_head,
        ]);
        $team_head = User::where('id', $request->team_head)->first();
        $team_head->assignRole('team-head');

        $team->users()->sync($request->team_members);

        if($request->has('save_create'))
            return back()->withToastSuccess(__('Team successfully created.'));
        elseif($request->has('save_next'))
            return redirect()->route('accreditation.index')->withToastSuccess(__('Team successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $team->with('users');
        $users = User::select('id','firstname','mi','surname')->role('member')->get();

        return view('team.edit',compact('users','team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $validate = Validator::make($request->all(), [
            'team_name'     => 'required|min:4',
            'team_head'     => 'required',
            'team_members'  => 'required',
        ]);

        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }

        foreach($request->team_members as $members) {
            if($members == $request->team_head)
                return back()->with('error', 'User cannot be both Team Head and Member')->withInput();
        }

        $team->update([
            'team_name' => $request->team_name,
            'team_head' => $request->team_head,
        ]);
        $team_head = User::where('id', $request->team_head)->first();
        $team_head->assignRole('team-head');

        $team->users()->sync($request->team_members);

        return back()->withToastSuccess(__('Team successfully updated.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return back()->withToastSuccess(__('Team successfully deleted.'));
    }

    public function assignTeam(Request $request, Accreditation $accreditation)
    {
        $validator = Validator::make($request->all(), [
            'document.*.team' => 'required:min:1',
        ],[
            'document.*.team.required' => 'Team is required'
        ]);

        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->first())->withInput();
        }

        $teams = [];
        $documents = [];
        if($request->document) {
            foreach($request->document as $key => $document_team) {
                foreach($document_team as $team) {
                    $teams[] = $team;
                    $documents[] = ['document_id' => $accreditation->document->id, 'document_outline_id' => $key, 'team_id' => $team];
                }
            }
        }

        $accreditation->teams()->sync($teams);
        $accreditation->document_teams()->detach();
        $accreditation->document_teams()->attach($documents);
        return back()->withToastSuccess(__('Team successfully assigned.'));
    }
}
