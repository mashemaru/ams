<?php

namespace App\Http\Controllers;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

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
}
