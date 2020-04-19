<?php

namespace App\Http\Controllers;

use App\Team;
use App\User;
use App\Accreditation;
use App\Notifications\EmailInvitations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
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
        $users = User::select('id','firstname','mi','surname')->get();

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

    public function userEmailInvitation(Request $request, Accreditation $accreditation)
    {
        $accreditation->load('agency','program');
        $users = User::whereIn('id', $request->team_members)->get();
        if($users) {
            foreach($users as $user) {
                $details = [
                    'user' => $user->name,
                    'accreditation' => $accreditation->agency->agency_code . '-' . $accreditation->program->program_code,
                    'actionURL' => URL::signedRoute('team-invite', ['user' => $user->id, 'accreditation' => $accreditation->id])
                ];
                $user->notify(new EmailInvitations($details));
            }
            return back()->withToastSuccess(__('User successfully notified.'));
        }
    }

    public function userAccreditationAssign(Request $request, User $user)
    {
        if (! $request->hasValidSignature()) {
            abort(401);
        }
        $accreditation = Accreditation::findOrFail($request->accreditation);
        // $accreditation->accreditation_users()->syncWithoutDetaching($user);
        // return back()->withToastSuccess(__('Team successfully created.'));
        return view('welcome', compact('accreditation','user'));
        // return 'User successfully added.';
    }

    public function postUserAccreditationAssign(Request $request)
    {
        $accreditation = Accreditation::findOrFail($request->accreditation);
        if ($request->invitation == 'accept') {
            $accreditation->accreditation_users()->syncWithoutDetaching($request->user);
            $accreditation->invites()->attach($request->user, [
                'is_accept' => 1
            ]);
            return back()->withToastSuccess(__('Team invitation successfully accepted.'));
        } else if ($request->invitation == 'reject') {
            $accreditation->invites()->attach($request->user, [
                'is_accept' => 0,
                'reason' => $request->reason
            ]);
            return back()->withToastSuccess(__('Team invitation successfully rejected.'));
        }
    }

    public function createTeam(Request $request, Accreditation $accreditation)
    {
        $users = $accreditation->accreditation_users;
        return view('team.accreditation.create',compact('users','accreditation'));
    }
    
    public function storeAccreditationTeam(Request $request, Accreditation $accreditation)
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

        $accreditation->invited_teams()->syncWithoutDetaching($team);
        $team_head = User::where('id', $request->team_head)->first();
        $team_head->assignRole('team-head');

        $team->users()->sync($request->team_members);

        if($request->has('save_create'))
            return back()->withToastSuccess(__('Team successfully created.'));
        elseif($request->has('save_next'))
            return redirect()->route('accreditation.index')->withToastSuccess(__('Team successfully created.'));
    }
    // invited_teams
}
