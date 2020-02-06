<?php

namespace App\Http\Controllers;

use App\User;
use App\Notifications\EmailInvitations;
use App\Accreditation;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function index(User $user)
    {
        return view('users.index', ['users' => $user->paginate(15)]);
    }

    /**
     * Show the form for creating a new user
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, User $user)
    {
        $user->create($request->merge(['password' => Hash::make($request->get('password'))])->all());

        return redirect()->route('user.index')->withToastSuccess(__('User successfully created.'));
    }

    /**
     * Show the form for editing the specified user
     *
     * @param  \App\User  $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $user->with('roles');
        $roles = Role::select('id','name','label')->get();
        $permissions = getPermissions();
        return view('users.edit', compact('user','roles','permissions'));
    }

    public function show(User $user)
    {
        $user->load('team_head','teams');
        $accreditations = Accreditation::with('teams','agency','program')->whereHas('teams', function ($query) use(&$user) {
            $query->whereIn('team_id', $user->teams->merge($user->team_head)->pluck('id')->toArray());
        });

        return view('users.view', ['user' => $user, 'accreditations' => $accreditations->get(), 'teams' => $user->teams->merge($user->team_head)]);
    }

    /**
     * Update the specified user in storage
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));
        $user->syncPermissions($request->permission);
        $user->syncRoles($request->roles);
        return redirect()->route('user.index')->withToastSuccess(__('User successfully updated.'));
    }

    /**
     * Remove the specified user from storage
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withToastSuccess(__('User successfully deleted.'));
    }

    public function roles_index()
    {
        $roles = Role::select('id','label')->get();
        return view('roles-permissions.index', compact('roles'));
    }

    public function roles_edit(Role $role)
    {
        $role->with('permissions')->get();
        $permissions = getPermissions();
        return view('roles-permissions.edit', compact('role','permissions'));
    }

    public function roles_update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permission);
        return redirect()->route('roles-permission.index')->withToastSuccess(__('Role permissions successfully updated.'));
    }

    public function userEmailInvitation(Request $request)
    {
        $users = User::whereIn('id', $request->team_members)->get();
        if($users) {
            foreach($users as $user) {
                $user->notify(new EmailInvitations());
            }
            return back()->withToastSuccess(__('User successfully notified.'));
        }
    }

    function addRole(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|unique:roles|min:2',
        ]);
    
        if ($validate->fails()) {
            return back()->with('error', $validate->messages())->withInput();
        }
    
        Role::create([
            'name' => str_replace(' ', '-', strtolower($request->name)),
            'label' => $request->name,
        ]);
    
        return back()->withToastSuccess(__('Role successfully created.'));
        Role::create(['name' => 'department-secretary', 'label' => 'Department Secretary']);
    }
}
