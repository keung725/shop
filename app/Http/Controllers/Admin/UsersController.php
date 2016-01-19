<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditFormRequest;
use App\User;
use App\Role;
use DB;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $roles = Role::all();
        $selectedRoles = $user->roles->lists('id')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'selectedRoles'));
    }

    public function update($id, UserEditFormRequest $request)
    {
        $user = User::whereId($id)->firstOrFail();
        if($request->get('name') == '') {
            $user->name = null;
        }else {
            $user->name = $request->get('name');
        }
        $user->save();
        $user->saveRoles($request->get('role'));

        return redirect(action('Admin\UsersController@edit', $user->id))->with('status', 'The user has been updated!');
    }
}
