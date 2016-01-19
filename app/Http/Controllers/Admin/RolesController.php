<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;

class RolesController extends Controller
{
    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(RoleFormRequest $request)
    {
        $role = new Role(array(
            'name' => $request->get('name'),
            'display_name' => $request->get('display_name'),
            'description' => $request->get('description')
        ));

        $role->save();

        return redirect('/admin/roles/create')->with('status', 'A new role has been created!');
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::whereId($id)->firstOrFail();
        return view('admin.roles.edit', compact('role'));
    }

    public function update($id, RoleFormRequest $request)
    {
        $role = Role::whereId($id)->firstOrFail();
        $role->name = $request->get('name');
        $role->display_name = $request->get('display_name');
        $role->description = $request->get('description');
        $role->save();

        return redirect(action('Admin\RolesController@edit', $role->id))->with('status', 'The role has been updated!');
    }
}
