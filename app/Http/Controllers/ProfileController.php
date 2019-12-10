<?php

namespace App\Http\Controllers;

use App\Accreditation;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        auth()->user()->load('team_head','teams');
        $accreditations = Accreditation::with('teams','agency','program')->whereHas('teams', function ($query) {
            $query->whereIn('team_id', auth()->user()->teams->merge(auth()->user()->team_head)->pluck('id')->toArray());
        });

        return view('profile.edit', ['accreditations' => $accreditations->get(), 'teams' => auth()->user()->teams->merge(auth()->user()->team_head)]);
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withToastSuccess(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withToastSuccess(__('Password successfully updated.'));
    }
}
