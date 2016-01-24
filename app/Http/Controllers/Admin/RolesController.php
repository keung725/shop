<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Response;
use DB;
use Request;

class RolesController extends Controller
{
    public function create()
    {
        return view('admin.roles.create');
    }

    public function store()
    {

        $input = Input::all();

        $rules = array(
            'name' => 'required',
            'display_name' => 'required',
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() )
        {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

        }
        else {
            $role = new Role(array(
                'name' => Input::get('name'),
                'display_name' => Input::get('display_name'),
                'description' => Input::get('description')
            ));

            $role->save();

            return Response::json(['success' => true, 'message'=>  'A new role has been created!']);
        }

    }

    public function index()
    {
        return view('admin.roles.index', compact('roles'));
    }

    public function edit($id)
    {
        $role = Role::whereId($id)->firstOrFail();
        return view('admin.roles.edit', compact('role'));
    }

    public function update($id)
    {
        $role = Role::whereId($id)->firstOrFail();
        $input = Input::all();

        $rules = array(
            'name' => 'required',
            'display_name' => 'required',
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() )
        {
            return Response::json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()]);

        }
        else {
            $role->name = Input::get('name');
            $role->display_name = Input::get('display_name');
            $role->description = Input::get('description');
            $role->save();

            return Response::json(['success' => true, 'message'=>  'The role has been updated!']);
        }
    }
}
